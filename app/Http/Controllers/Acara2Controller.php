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

class Acara2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $query = Acara::where('tipe', 2);

            if ($request->has('year')) {
                $year = $request->input('year');
                $query->where(function($q) use ($year) {
                    $q->whereYear('tanggal_awal_acara', $year)
                    ->orWhereYear('tanggal_akhir_acara', $year);
                });
            }

            $acara2 = $query->paginate(25);
            return view('acara2.index', ['acara2' => $acara2, 'year' => $year ?? '']);
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
            return view('acara2.create');
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

        return redirect()->route('acara2.index')->with('success', 'Data Acara berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function show(Acara $acara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function edit(Acara $acara2)
    {
        if (Gate::allows('is-admin')) {
            return view('acara2.edit', ['acara2' => $acara2]);
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acara $acara2)
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
        $acara2->update(array_merge($validatedData, ['status_acara' => $statusAcara]));

        // Update the Acara model
        $acara2->update($updateData);

        return redirect()->route('acara2.index')->with('success', 'Data Acara diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acara $acara)
    {
        //
    }
}
