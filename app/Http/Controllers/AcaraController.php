<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\AnggotaAcaraRegistrasi;
use App\Models\AnggotaKehadiranRegistrasi;
use App\Models\Biodata;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\AbsenceSubmitted;
use Illuminate\Support\Str;
use LaravelQRCode\Facades\QRCode;


class AcaraController extends Controller
{

    private function getActiveAcara()
    {
        return Acara::where('status_acara', 1)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the user is authorized to view the page
        if (Gate::allows('is-non-publik')) {
            // Check if the request is coming from a mobile device
            if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false) {

                $user = auth()->user();
                $biodata = $user->biodata;

                $acaras = $this->getActiveAcara();

                // Fetch QR code links for each acara
                foreach ($acaras as $acara) {
                    $acara->qr_code_link = url('qrcodes/registrasi/' . $acara->qrcode_registrasi);
                }

                return view('mobile.acara.index', ['acaras' => $acaras]);
            }
        } elseif (Gate::allows('is-publik')) {
            if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false) {
                    $user = auth()->user();

                    $acaras = $this->getActiveAcara();

                    return view('mobile.acara.index', ['acaras' => $acaras]);
            }
        }

        // If the user is not authorized, return a 403 Forbidden error
        abort(403, 'Unauthorized action');
    }

    public function admin(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $query = Acara::where('tipe', 1);

            if ($request->has('year')) {
                $year = $request->input('year');
                $query->where(function($q) use ($year) {
                    $q->whereYear('tanggal_awal_acara', $year)
                    ->orWhereYear('tanggal_akhir_acara', $year);
                });
            }

            $acaras = $query->paginate(25);
            return view('acara.index', ['acaras' => $acaras, 'year' => $year ?? '']);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('is-admin') || Gate::allows('is-staf')) {
            return view('acara.create');
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_acara' => 'required',
            'lokasi_acara' => 'required',
            'tanggal_awal_acara' => 'required|date',
            'tanggal_akhir_acara' => 'required|date',
            'deskripsi_acara' => 'required',
            'tingkat_wilayah_acara' => 'required',
            'tipe' => 'nullable',
        ]);

       // Set status_acara to true (1) explicitly
        $validatedData['status_acara'] = 1;

        // Convert date string format to default format
        //$tanggal_awal_acara = Carbon::createFromFormat('d-m-Y', $request->tanggal_awal_acara)->format('Y-m-d');
        //$tanggal_akhir_acara = Carbon::createFromFormat('d-m-Y', $request->tanggal_akhir_acara)->format('Y-m-d');

        //dd($validatedData);

        // Create a new Acara instance with the validated data
        Acara::create($validatedData);

        return redirect()->route('acara.index')->with('success', 'Data Acara berhasil dibuat');
    }

    public function register(Request $request)
    {
        // Retrieve the currently logged-in user's data
        $user = auth()->user();

        $request->validate([
            'acara_id' => ['required', 'exists:acara,id', 'not_registered_for_event'], // Validate that acara_id exists in the acara table
            'qrcode_registrasi' => 'nullable',
            'mandat' => 'nullable|file|image|max:2048',
        ]);

        // Construct the URL for any route with additional data as query parameters
        //$baseUrl = 'http://192.168.1.10/esiaga2/public/absen';
        $baseUrl = 'https://e-siaga.com/aprizal/public/absen';

        // Construct the URL for the absen route with additional data as query parameters
        $url = $baseUrl . '?user_id=' . $user->id . '&acara_id=' . $request->input('acara_id');

        // Generate a unique filename
        $filename = Str::random(20) . '.svg';

        // Define the path to the public directory where the QR code will be saved
        $publicPath = public_path('qrcodes/registrasi');

        /* $existingRegistration = AnggotaAcaraRegistrasi::where('user_id', $user->id)
            ->where('acara_id', $request->input('acara_id'))
            ->exists();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'User sudah terdaftar event ini');
        } */

        // Generate the QR code SVG and save it to the public directory
        QRCode::url($url)
            ->setSize(5)
            ->setMargin(2)
            ->setOutfile($publicPath . '/' . $filename)
            ->svg();

        if ($request->hasFile('mandat')) {
                $file1 = $request->file('mandat');
                $nama_file1 =  auth()->user()->name . '_' . $file1->getClientOriginalName();
                $tujuan_upload = 'mandat';
                $file1->move($tujuan_upload, $nama_file1);
        }else {
            $nama_file1 = null; // or whatever default value you want to set
        }

        // Create a new instance of AnggotaAcaraRegistrasi and fill in the fields
        $anggotaAcaraRegistrasi = new AnggotaAcaraRegistrasi([
            'user_id' => $user->id,
            'acara_id' => $request->input('acara_id'),
            'qrcode_registrasi' => $filename,
            'mandat' => $nama_file1,
        ]);

        // Save the instance to the database
        $anggotaAcaraRegistrasi->save();

        // Redirect the user back to the index page
        return redirect()->route('mobile.acara.index')->with('success', 'Berhasil daftar acara ini');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Acara $acara)
    {
        if (Gate::allows('is-admin')) {
            return view('acara.edit', ['acara' => $acara]);
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acara $acara)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_acara' => 'required',
            'lokasi_acara' => 'required',
            'tanggal_awal_acara' => 'required|date',
            'tanggal_akhir_acara' => 'required|date|after_or_equal:tanggal_awal_acara',
            'deskripsi_acara' => 'required|string',
            'tingkat_wilayah_acara' => 'required',
            // Add other validation rules for additional fields...
        ]);

        /// Set the 'status_acara' attribute in the update data based on the presence of the field in the request
        $updateData = [
            'nama_acara' => $validatedData['nama_acara'],
            'lokasi_acara' => $validatedData['lokasi_acara'],
            'tanggal_awal_acara' => $validatedData['tanggal_awal_acara'],
            'tanggal_akhir_acara' => $validatedData['tanggal_akhir_acara'],
            'deskripsi_acara' => $validatedData['deskripsi_acara'],
            'tingkat_wilayah_acara' => $validatedData['tingkat_wilayah_acara'],
            // Add other fields as needed...
        ];

        // Process the status_acara value from the request
        $statusAcara = $request->input('status_acara') == '1' ? true : false;

        // Update the Acara model
        $acara->update(array_merge($validatedData, ['status_acara' => $statusAcara]));

        // Update the Acara model
        $acara->update($updateData);

        return redirect()->route('acara.index')->with('success', 'Data Acara diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Acara::destroy($id);

        return redirect()->route('acara.index')->with('danger', 'Data Acara berhasil dihapus');
    }

}
