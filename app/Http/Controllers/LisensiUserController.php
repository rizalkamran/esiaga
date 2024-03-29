<?php

namespace App\Http\Controllers;

use App\Models\Lisensi;
use App\Models\ReffCabor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LisensiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-non-publik')) {
            $lisensi = Lisensi::where('user_id', auth()->user()->id)->get();
            return view('mobile.lisensi.index', ['lisensi' => $lisensi]);
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
        if (Gate::allows('is-non-publik')) {
            // Get the authenticated user's ID
            $user_id = auth()->user()->id;
            $cabor = ReffCabor::all();

            return view('mobile.lisensi.create', [
                'user_id' => $user_id,
                'cabor' => $cabor,
            ]);
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
        $user_id = auth()->user()->id;

        $username = auth()->user()->name;

        $request->validate([
            'user_id' => 'required',
            'cabor_id' => 'required',
            'tingkat' => 'required|string',
            'profesi' => 'required|string',
            'nama_lisensi' => 'required|string',
            'nomor_lisensi' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'penyelenggara' => 'required|string',
            'foto_lisensi' => 'nullable|file|image|max:1024',
        ]);

        if ($request->hasFile('foto_lisensi')) {
            $file1 = $request->file('foto_lisensi');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName(); // Appending timestamp
            $tujuan_upload = 'foto_lisensi';
            $file1->move($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }

        // Create Biodata instance with the validated data and file paths
        Lisensi::create([
            'user_id' => $request->user_id,
            'cabor_id' => $request->cabor_id,
            'tingkat' => $request->tingkat,
            'profesi' => $request->profesi,
            'nama_lisensi' => $request->nama_lisensi,
            'nomor_lisensi' => $request->nomor_lisensi,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'penyelenggara' => $request->penyelenggara,
            'foto_lisensi' => $nama_file1,
        ]);

        return redirect()->route('mobile.lisensi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lisensi  $lisensi
     * @return \Illuminate\Http\Response
     */
    public function show(Lisensi $lisensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lisensi  $lisensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lisensi $lisensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lisensi  $lisensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lisensi $lisensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lisensi  $lisensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lisensi $lisensi)
    {
        //
    }
}
