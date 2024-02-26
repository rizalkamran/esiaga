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
                return view('mobile.acara.index', ['acaras' => $acaras]);

                /* if ($biodata) {
                    // If it's a mobile device and biodata exists, return the mobile view
                    $acaras = $this->getActiveAcara();
                    return view('mobile.acara.index', ['acaras' => $acaras]);
                } else {
                    // If biodata doesn't exist, redirect to biodata create route
                    return redirect()->route('mobile.biodata.create')->with('error', 'Agar dapat melanjutkan proses, silahkan lengkapi profil biodata Anda terlebih dahulu, terima kasih.');
                } */
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

    public function admin()
    {
        if (Gate::allows('is-admin')){
            $acaras = Acara::paginate(5); // Paginate with * records per page
            return view('acara.index', ['acaras' => $acaras]);
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
        if (Gate::allows('is-admin')) {
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
            'security_pass' => 'required',
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'acara_id' => ['required', 'exists:acara,id', 'not_registered_for_event'], // Validate that acara_id exists in the acara table
            'qrcode_registrasi' => 'nullable'
        ]);

        // Retrieve the currently logged-in user's ID
        $user_id = Auth::id();

        // Create a new instance of AnggotaAcaraRegistrasi and fill in the fields
        $anggotaAcaraRegistrasi = new AnggotaAcaraRegistrasi([
            'user_id' => $user_id,
            'acara_id' => $request->input('acara_id'),
            'qrcode_registrasi' => $request->input('qrcode_registrasi'),
        ]);

        // Save the instance to the database
        $anggotaAcaraRegistrasi->save();

        // Redirect the user back to the index page
        return redirect()->route('mobile.acara.index')->with('success', 'Berhasil daftar acara ini');
    }

    /* public function kehadiran(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'acara_id' => ['required', 'exists:acara,id'], // Validate that acara_id exists in the acara table
            'security_pass' => ['required'], // Validate that security_pass is provided
        ]);

        // Retrieve the currently logged-in user's ID
        $user_id = Auth::id();

        // Check if the event exists
        $event = Acara::find($validatedData['acara_id']);
        if (!$event) {
            return redirect()->back()->with('error', 'Acara tidak ditemukan.');
        }

        // Check if the user is registered for the event
        $isRegistered = $event->anggotaAcaraRegistrasi()->where('user_id', $user_id)->exists();
        if (!$isRegistered) {
            return redirect()->back()->with('error', 'Anda harus mendaftar untuk acara ini terlebih dahulu.');
        }

        // Check if the security passphrase matches the event's security_pass
        if ($validatedData['security_pass'] !== $event->security_pass) {
            return redirect()->back()->with('error', 'Security tidak valid.');
        }

        // Check if the current date is within the event's date range
        $currentDate = today();
        if ($currentDate->isBefore($event->tanggal_awal_acara) || $currentDate->isAfter($event->tanggal_akhir_acara)) {
            return redirect()->back()->with('error', 'Anda hanya bisa absen pada tanggal acara.');
        }

        // Check if the user has already recorded attendance for the current day within the event's date range
        $alreadyAttended = AnggotaKehadiranRegistrasi::where('user_id', $user_id)
            ->where('acara_id', $validatedData['acara_id'])
            ->whereDate('created_at', $currentDate->toDateString())
            ->exists();

        if ($alreadyAttended) {
            return redirect()->back()->with('error', 'Anda sudah absen hari ini.');
        }

        // Create a new instance of AnggotaKehadiranRegistrasi and fill in the fields
        AnggotaKehadiranRegistrasi::create([
            'user_id' => $user_id,
            'acara_id' => $validatedData['acara_id'],
            // Add other fields as needed...
        ]);

        // Fire event
        event(new AbsenceSubmitted($validatedData)); // Pass validatedData or any other relevant data you want to send

        // Redirect the user back to the index page
        return redirect()->route('mobile.acara.index')->with('success', 'Kehadiran berhasil direkam');
    }
 */

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
            'security_pass' => 'required',
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
            'security_pass' => $validatedData['security_pass'],
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

        return redirect()->route('acara.index')->with('danger', 'Data Acara berhasil dihapus');;
    }

}
