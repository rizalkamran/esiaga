<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPeran;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use App\Models\ReffPeran;
use App\Models\ReffCabor;
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


        if (Gate::allows('is-publik')) {
            $users = User::paginate(5);

            $anggotaPerans = AnggotaPeran::where('user_id', auth()->user()->id)->paginate(10); // Change 10 to your desired number of items per page
            return view('publik.anggota_peran.index', compact('anggotaPerans'));
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
        if (Gate::allows('is-publik')) {
            // Get the authenticated user's ID
            $userId = auth()->user()->id;

            // Retrieve the necessary data from other tables
            $reffPerans = ReffPeran::all();
            $reffCabors = ReffCabor::all();

            // Pass the data to the view
            return view('publik.anggota_peran.create', compact('userId', 'reffPerans', 'reffCabors'));
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
        return redirect()->route('publik.anggota_peran.index')->with('success', 'Data Berhasil dibuat, harap menunggu verifikasi');
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
    public function edit(AnggotaPeran $anggotaPeran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggotaPeran $anggotaPeran)
    {
        //
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
