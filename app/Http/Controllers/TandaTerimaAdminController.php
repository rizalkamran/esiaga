<?php

namespace App\Http\Controllers;

use App\Models\TandaTerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Acara;
use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class TandaTerimaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin')) {
            $tandaterima = TandaTerima::paginate(25);
            $acaraOptions = Acara::all();
            $selectedAcara = $request->input('acara');
            return view('tanda_terima.index', [
                'tandaterima' => $tandaterima,
                'acaraOptions' => $acaraOptions,
                'selectedAcara' => $selectedAcara,
            ]);
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
            // Retrieve all users to populate dropdown/select
            $users = User::all();
            $acara = Acara::all();

            // Pass the users and sessions data to the view
            return view('tanda_terima.create', compact('users', 'acara'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->bukti);

        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'acara_id' => 'required|exists:acara,id|not_registered_for_event',
            'status_baju' => 'nullable',
            'status_sertifikat' => 'nullable',
            'status_idcard' => 'nullable',
            'bukti' => 'nullable',
            'tgl_terima' => 'nullable|date',
        ]);

        // Check if there is already a record for the selected user and event
        $existingRecord = TandaTerima::where('user_id', $request->user_id)
            ->where('acara_id', $request->acara_id)
            ->exists();

        // If there is an existing record, return with an error message
        if ($existingRecord) {
            return redirect()->back()->withErrors(['user_id' => 'Sudah membuat tanda terima untuk acara ini.']);
        }

        // Get the authenticated user's data
        $user = User::findOrFail($request->user_id);

        // Convert the request tgl_terima input to a Carbon instance and format it
        $tgl_terima_formatted = Carbon::createFromFormat('Y-m-d', $request->tgl_terima)->locale('id')->translatedFormat('j F Y');

        // Generate QR code data with customized field names and header
        $qrCodeData = [
            'Header' => 'Informasi Tanda Terima',
            'Nama' => $user->nama_lengkap,
            'NIK' => $user->nomor_ktp,
            'Tanggal Terima' => $tgl_terima_formatted,
        ];

        // Generate a unique filename
        $filename = Str::random(20) . '.svg';

        // Define the path to the public directory where the QR code will be saved
        $publicPath = public_path('qrcodes/tanda_terima');

        // Generate the QR code SVG and save it to the public directory
        QRCode::text(json_encode($qrCodeData))
        ->setSize(3)
        ->setOutfile($publicPath . '/' . $filename)
        ->svg();

        // Create a new record with the QR code path (using the relative path directly)
        TandaTerima::create([
        'user_id' => $request->user_id,
        'acara_id' => $request->acara_id,
        'status_baju' => $request->status_baju,
        'status_sertifikat' => $request->status_sertifikat,
        'status_idcard' => $request->status_idcard,
        'bukti' => $filename, // Use relative path directly
        'tgl_terima' => $request->tgl_terima,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tanda Terima telah direkam');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function show(TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function edit(TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function destroy(TandaTerima $tandaTerima)
    {
        //
    }

    public function exportPDF(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Retrieve the 'acara' parameter from the request
            $selectedAcara = $request->input('acara');

            // Build your query based on conditions
            $query = TandaTerima::query();

            // Apply the condition for 'acara_id'
            if ($selectedAcara) {
                $query->where('acara_id', $selectedAcara);
            }

            // Fetch data from the database based on the query
            $tandaterima = $query->get();

            // Pass $selectedAcara to the view along with $tandaterima
            $viewData = [
                'tandaterima' => $tandaterima,
                'selectedAcara' => $selectedAcara,
            ];

            // Load the view and pass data to it, including the QR code URL and image
            $pdf = PDF::loadView('tanda_terima.export-pdf', $viewData);

            // Set paper orientation to landscape
            $pdf->setPaper('a4', 'landscape');

            // Stream the PDF to the browser
            return $pdf->stream('tanda_terima.pdf');
        }

        abort(403, 'Unauthorized action');
    }

}
