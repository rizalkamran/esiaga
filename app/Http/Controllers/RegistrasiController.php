<?php

namespace App\Http\Controllers;

use App\Models\AnggotaAcaraRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Acara;
use App\Models\ReffPeran;
use App\Models\ReffCabor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;
use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\File;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Start with the base query
        $query = AnggotaAcaraRegistrasi::query();
        $acaraOptions = Acara::all();
        $caborOptions = ReffCabor::all();
        $peranOptions = ReffPeran::all();

        // Retrieve the selected acara, cabor, nama_peran, and search query from the request
        $selectedAcara = $request->input('acara');
        $selectedCabor = $request->input('cabor');
        $selectedPeran = $request->input('peran'); // New input for nama_peran filter
        $searchQuery = $request->input('search');

        // Filter by acara if selected
        if ($selectedAcara) {
            $query->whereHas('acara', function ($q) use ($selectedAcara) {
                $q->where('id', $selectedAcara);
            });
        }

        // Filter by cabor if selected
        if ($selectedCabor) {
            $query->whereHas('user.biodata.cabor', function ($q) use ($selectedCabor) {
                $q->where('nama_cabor', 'like', '%' . $selectedCabor . '%');
            });
        }

        // Filter by nama_peran if selected
        if ($selectedPeran) {
            $query->whereHas('peran', function ($q) use ($selectedPeran) {
                $q->where('id', $selectedPeran);
            });
        }

        // Filter by search query
        if ($searchQuery) {
            $query->whereHas('user', function ($q) use ($searchQuery) {
                $q->where('nama_lengkap', 'like', '%' . $searchQuery . '%')
                    ->orWhere('nomor_ktp', 'like', '%' . $searchQuery . '%')
                    ->orWhere('name', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('biodata.cabor', function ($q) use ($searchQuery) {
                        $q->where('nama_cabor', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        // If no search query and acara/cabor filters, apply only status_acara filter
        if (!$searchQuery && !$selectedAcara && !$selectedCabor) {
            $query->whereHas('acara', function ($q) {
                $q->where('status_acara', 1);
            });
        }

        $anggota = $query->paginate(10);

        // Calculate the total counts outside of the paginated query
        $totalFoto = AnggotaAcaraRegistrasi::whereHas('user.biodata', function ($q) {
            $q->whereNotNull('foto_diri');
        })->count();

        $totalKTP = AnggotaAcaraRegistrasi::whereHas('user.biodata', function ($q) {
            $q->whereNotNull('foto_ktp');
        })->count();

        $totalNPWP = AnggotaAcaraRegistrasi::whereHas('user.biodata', function ($q) {
            $q->whereNotNull('foto_npwp');
        })->count();

        // Return the view with data and options
        return view('registrasi.index', [
            'anggota' => $anggota,
            'acaraOptions' => $acaraOptions,
            'caborOptions' => $caborOptions,
            'peranOptions' => $peranOptions, // Add peranOptions here
            'selectedAcara' => $selectedAcara,
            'selectedCabor' => $selectedCabor,
            'selectedPeran' => $selectedPeran, // Pass selectedPeran to the view
            'searchQuery' => $searchQuery,
            'totalFoto' => $totalFoto,
            'totalKTP' => $totalKTP,
            'totalNPWP' => $totalNPWP,
        ]);
    }

    public function showUserEvents()
    {
        if (Gate::allows('is-non-publik')) {
            $regis = AnggotaAcaraRegistrasi::where('user_id', auth()->user()->id)->get(); // Change 10 to the desired number of items per page
            return view('mobile.acara.detail', ['regis' => $regis]);
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmin()
    {
        if (Gate::allows('is-admin')) {
            $user = User::all();
            $peran = ReffPeran::all();
            $acara = Acara::where('status_acara', 1)->get(); // Retrieve only active Acara records
            return view('registrasi.create', ['acara' => $acara, 'user' => $user, 'peran' => $peran]);
        }

        abort(403, 'Unauthorized action.');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'peran_id' => 'required',
            'acara_id' => ['required', 'exists:acara,id'], // Ensure the user is not already registered for the event
            'qrcode_registrasi' => 'nullable'
        ]);

        // Check if the user is already registered for the event
        $existingRegistration = AnggotaAcaraRegistrasi::where('user_id', $request->input('user_id'))
            ->where('acara_id', $request->input('acara_id'))
            ->exists();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'User sudah terdaftar event ini');
        }

        /// Retrieve the currently logged-in user's data
        $user = auth()->user();

        // Construct the URL for any route with additional data as query parameters
        //$baseUrl = 'http://192.168.1.10/esiaga2/public/absen';
        $baseUrl = 'https://e-siaga.com/aprizal/public/absen';

        // Construct the URL for the absen route with additional data as query parameters
        $url = $baseUrl . '?user_id=' . $request->input('user_id') . '&acara_id=' . $request->input('acara_id');

        // Generate a unique filename
        $filename = Str::random(20) . '.svg';

        // Define the path to the public directory where the QR code will be saved
        $publicPath = public_path('qrcodes/registrasi');

        // Generate the QR code SVG and save it to the public directory
        QRCode::url($url)
            ->setSize(5)
            ->setMargin(2)
            ->setOutfile($publicPath . '/' . $filename)
            ->svg();

        // Create a new instance of AnggotaAcaraRegistrasi and fill in the fields
        $anggotaAcaraRegistrasi = new AnggotaAcaraRegistrasi([
            'user_id' => $request->input('user_id'),
            'peran_id' => $request->input('peran_id'),
            'acara_id' => $request->input('acara_id'),
            'qrcode_registrasi' => $filename,
        ]);

        // Save the instance to the database
        $anggotaAcaraRegistrasi->save();

        // Optionally, you can redirect the user to a different page after successful submission
        return redirect()->route('registrasi.index')->with('success', 'Registration successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function show(AnggotaAcaraRegistrasi $anggotaAcaraRegistrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggotaAcaraRegistrasi = AnggotaAcaraRegistrasi::findOrFail($id);
        return view('registrasi.edit', compact('anggotaAcaraRegistrasi'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mandat' => 'nullable|file|max:2048',
            // Add other validation rules as needed
        ]);

        $anggotaAcaraRegistrasi = AnggotaAcaraRegistrasi::findOrFail($id);

        $anggotaAcaraRegistrasi->update($request->all());

        if ($request->hasFile('mandat')) {
            $file1 = $request->file('mandat');
            $nama_file1 = auth()->user()->name . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'mandat';

            // Delete the old file if it exists
            if ($anggotaAcaraRegistrasi->mandat) {
                $oldFilePath = public_path($tujuan_upload . '/' . $anggotaAcaraRegistrasi->mandat);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $anggotaAcaraRegistrasi->mandat = null;
                    $anggotaAcaraRegistrasi->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $anggotaAcaraRegistrasi->mandat = $nama_file1;
        }

        // Save the updated data
        $anggotaAcaraRegistrasi->save();

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('registrasi.index')->with('success', 'Mandat updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggotaAcaraRegistrasi $anggotaAcaraRegistrasi)
    {
        //
    }

    public function exportPDF(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Retrieve the 'acara' parameter from the request
            $selectedAcara = $request->input('acara');

            // Build your query based on conditions
            $query = AnggotaAcaraRegistrasi::query();

            // Apply the condition for 'acara_id'
            if ($selectedAcara) {
                $query->where('acara_id', $selectedAcara);
            }

            // Fetch data from the database based on the query
            $anggota = $query->get();

            // Pass $selectedAcara to the view along with $anggota
            $viewData = [
                'anggota' => $anggota,
                'selectedAcara' => $selectedAcara, // Add this line
            ];

            // Load the view and pass data to it, including the QR code URL and image
            $pdf = PDF::loadView('registrasi.export-pdf', $viewData);

            // Set paper orientation to landscape
            $pdf->setPaper('a4', 'landscape');

            // Stream the PDF to the browser
            return $pdf->stream('registrasi.pdf');
        }

        abort(403, 'Unauthorized action');
    }

    public function exportPDFPublic(Request $request)
    {
        // Retrieve the 'acara' parameter from the request
        $selectedAcara = $request->input('acara');

        // Build your query based on conditions
        $query = AnggotaAcaraRegistrasi::query();

        // Apply the condition for 'acara_id'
        if ($selectedAcara) {
            $query->where('acara_id', $selectedAcara);
        }

        // Fetch data from the database based on the query
        $anggota = $query->get();

        // Pass $selectedAcara to the view along with $anggota
        $viewData = [
            'anggota' => $anggota,
            'selectedAcara' => $selectedAcara,
        ];

        // Load the view and pass data to it, including the QR code URL and image
        $pdf = PDF::loadView('registrasi.export-pdf', $viewData);

        // Set paper orientation to landscape
        $pdf->setPaper('a4', 'landscape');

        // Stream the PDF to the browser
        return $pdf->stream('registrasi_public_access.pdf');
    }

    public function exportUser($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Find the user registration record by ID
            $anggota = AnggotaAcaraRegistrasi::findOrFail($id);

            // Load the view and pass data to it
            $pdf = PDF::loadView('registrasi.export-user-pdf', compact('anggota'));

            // Set paper orientation to landscape
            $pdf->setPaper('a4', 'portrait');

            // Generate a unique filename for the PDF
            $filename = 'registrasi_' . $anggota->user->name . '.pdf';

            // Stream the PDF to the browser with the given filename
            return $pdf->stream($filename);
        }

        abort(403, 'Unauthorized action');
    }

}
