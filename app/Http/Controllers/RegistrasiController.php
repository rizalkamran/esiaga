<?php

namespace App\Http\Controllers;

use App\Models\AnggotaAcaraRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Acara;
use App\Models\ReffCabor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all acara options for the dropdown
        $acaraOptions = Acara::all();

        // Retrieve all cabor options for the dropdown
        $caborOptions = ReffCabor::all();

        // Retrieve the selected acara and cabor (if any) from the request
        $selectedAcara = $request->input('acara');
        $selectedCabor = $request->input('cabor');
        $searchQuery = $request->input('search');
        $showAll = $request->input('showAll'); // Check if the toggle button is clicked

        // Start with the base query
        $query = AnggotaAcaraRegistrasi::query();

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

        // Check if the toggle button is clicked
        if ($showAll) {
            // Retrieve all data without pagination
            $anggota = $query->get();
        } else {
            // Paginate the data (default behavior)
            $anggota = $query->paginate(10);
        }

        // Return the view with data and options
        return view('registrasi.index', [
            'anggota' => $anggota,
            'acaraOptions' => $acaraOptions,
            'caborOptions' => $caborOptions,
            'selectedAcara' => $selectedAcara,
            'selectedCabor' => $selectedCabor,
            'searchQuery' => $searchQuery
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('is-non-publik')) {
            $acara = Acara::where('status_acara', 1)->get(); // Retrieve only active Acara records
            return view('mobile.registrasi.create', ['acara' => $acara]);
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve the currently logged-in user's ID
        $user_id = Auth::id();

        $request->validate([
            'acara_id' => ['required', 'exists:acara,id', 'not_registered_for_event'], // Validate that acara_id exists in the acara table
            'qrcode_registrasi' => 'nullable'
        ]);

        // Merge the user_id into the request data
        $requestData = array_merge($request->all(), ['user_id' => $user_id]);

        // Dump and die to inspect the request data before proceeding
        //dd($requestData);

        // Create a new instance of AnggotaAcaraRegistrasi and fill in the fields
        $anggotaAcaraRegistrasi = new AnggotaAcaraRegistrasi([
            'user_id' => $user_id,
            'acara_id' => $request->input('acara_id'),
            'qrcode_registrasi' => $request->input('qrcode_registrasi'),
        ]);

        // Save the instance to the database
        $anggotaAcaraRegistrasi->save();

        // Optionally, you can redirect the user to a different page after successful submission
        return redirect()->route('mobile.registrasi.index');
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

        // Process and store the first file if uploaded
        if ($request->hasFile('mandat')) {
            $file1 = $request->file('mandat');
            $nama_file1 = auth()->user()->name . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'mandat';
            $file1->storeAs($tujuan_upload, $nama_file1);
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

        // Load the view and pass data to it
        $pdf = PDF::loadView('registrasi.export-pdf', compact('anggota'));

        // Set paper orientation to landscape
        $pdf->setPaper('a4', 'landscape');

        // Stream the PDF to the browser
        return $pdf->stream('registrasi.pdf');
    }

}
