<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PekerjaanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-non-publik')) {
            $pekerjaan = Pekerjaan::where('user_id', auth()->user()->id)->get();
            return view('mobile.pekerjaan.index', ['pekerjaan' => $pekerjaan]);
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

            return view('mobile.pekerjaan.create', [
                'user_id' => $user_id,
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
        $request->validate([
            'user_id' => 'required',
            'pekerjaan' => 'required',
            'jabatan' => 'required|string',
            'nama_instansi' => 'required|string',
            'alamat_instansi' => 'required|string',
            'kontak_instansi' => 'required|string',
            'tipe_kerja' => 'required|string',
            'status_kerja' => 'nullable|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'bukti_kerja' => 'nullable|file|image|max:1024',
        ]);

        $user_id = auth()->user()->id;

        $username = auth()->user()->name;

        if ($request->hasFile('bukti_kerja')) {
            $file1 = $request->file('bukti_kerja');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName(); // Appending timestamp
            $tujuan_upload = 'bukti_kerja';
            $file1->move($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }

        // Create Biodata instance with the validated data and file paths
        Pekerjaan::create([
            'user_id' => $request->user_id,
            'pekerjaan' => $request->pekerjaan,
            'jabatan' => $request->jabatan,
            'nama_instansi' => $request->nama_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'kontak_instansi' => $request->kontak_instansi,
            'tipe_kerja' => $request->tipe_kerja,
            'status_kerja' => $request->status_kerja,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'bukti_kerja' => $nama_file1,
        ]);

        return redirect()->route('mobile.pekerjaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        //
    }
}
