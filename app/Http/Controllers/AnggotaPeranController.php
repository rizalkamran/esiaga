<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPeran;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use App\Models\ReffPeran;
use App\Models\ReffCabor;
use App\Models\ReffKota;
use Illuminate\Http\Request;

class AnggotaPeranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve records related to the authenticated user's ID with pagination


        if (Gate::allows('is-non-publik')) {

            if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false) {
                $anggotaperan = AnggotaPeran::where('user_id', auth()->user()->id)->get(); // Change 10 to your desired number of items per page
                return view('mobile.anggota.index', ['anggotaperan' => $anggotaperan]);
            }

        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('is-non-publik')) {
            // Get the authenticated user's ID
            $user_id = auth()->user()->id;

            // Retrieve the necessary data from other tables
            $reffPerans = ReffPeran::all();
            $reffCabors = ReffCabor::all();
            $kota = ReffKota::all();

            // Pass the data to the view
            return view('mobile.anggota.create', compact('user_id', 'reffPerans', 'reffCabors', 'kota'));
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
        // Validate the form data...
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'peran_id' => 'required|integer',
            'cabor_id' => 'required|integer',
            'jabatan' => 'nullable|string|max:100',
            'nama_lembaga' => 'required|string|max:100',
            'provinsi_lembaga' => 'required|string|max:30',
            'kota_lembaga' => 'required|string|max:30',
            'kecamatan_lembaga' => 'required|string|max:30',
        ]);

        // Set default values for status_aktif_peran and status_verifikasi_peran
        $validatedData['status_aktif_peran'] = true;
        $validatedData['status_verifikasi_peran'] = false;

        // Dump and die to inspect the validated data
        //dd($validatedData);

        // Create a new AnggotaPeran instance with the form data
        AnggotaPeran::create($validatedData);

        // Redirect or do something else...
        return redirect()->route('mobile.anggota.index')->with('success', 'Data Berhasil dibuat, harap menunggu verifikasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function show(AnggotaPeran $anggotaPeran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ensure that the user is authorized to edit
        if (Gate::allows('is-non-publik')) {
            // Retrieve the AnggotaPeran instance by its ID
            $anggota = AnggotaPeran::findOrFail($id);

            // Retrieve any necessary data for the view
            $reffPerans = ReffPeran::all();
            $reffCabors = ReffCabor::all();
            $kota = ReffKota::all();

            // Pass the retrieved data to the view
            return view('mobile.anggota.edit', [
                'anggota' => $anggota,
                'reffPerans' => $reffPerans,
                'reffCabors' => $reffCabors,
                // Add any other data you need in the view
            ]);
        }

        // If the user is not authorized, return a 403 Forbidden error
        abort(403, 'Unauthorized action');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            //'user_id' => 'required',
            'peran_id' => 'required',
            'cabor_id' => 'required',
            'jabatan' => 'nullable|string',
            'nama_lembaga' => 'nullable|string',
            'provinsi_lembaga' => 'nullable|string',
            'kota_lembaga' => 'nullable|string',
            'kecamatan_lembaga' => 'nullable|string',
        ]);

        // Find the biodata entry by its ID
        $anggota = AnggotaPeran::findOrFail($id);

        // Update the biodata entry with the validated data from the request
        $anggota->update($request->all());

        // Save the updated biodata entry with file paths
        $anggota->save();

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('mobile.anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggotaPeran $anggotaPeran)
    {
        //
    }
}
