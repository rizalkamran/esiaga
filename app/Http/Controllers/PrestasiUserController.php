<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\ReffCabor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PrestasiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-non-publik')) {
            $prestasi = Prestasi::where('user_id', auth()->user()->id)->get();
            return view('mobile.prestasi.index', ['prestasi' => $prestasi]);
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

            return view('mobile.prestasi.create', [
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
        $username = auth()->user()->name;

        $request->validate([
            'user_id' => 'required',
            'cabor_id' => 'required',
            'tipe_prestasi' => 'required|string',
            'nama_event' => 'required|string',
            'nama_team' => 'nullable|string',
            'prestasi' => 'required|string',
            'catatan' => 'nullable|string',
            'rekor' => 'nullable|string',
            'tahun' => 'required|date_format:Y',
            'nomor_bukti_prestasi' => 'required',
            'file_bukti_prestasi' => 'nullable|file|image|max:1024',
        ]);

        // Process and store the first file if uploaded
        if ($request->hasFile('file_bukti_prestasi')) {
            $file1 = $request->file('file_bukti_prestasi');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName(); // Appending timestamp
            $tujuan_upload = 'file_bukti_prestasi';
            $file1->move($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }


        // Create Biodata instance with the validated data and file paths
        Prestasi::create([
            'user_id' => $request->user_id,
            'cabor_id' => $request->cabor_id,
            'tipe_prestasi' => $request->tipe_prestasi,
            'nama_event' => $request->nama_event,
            'nama_team' => $request->nama_team,
            'prestasi' => $request->prestasi,
            'catatan' => $request->catatan,
            'rekor' => $request->rekor,
            'tahun' => $request->tahun,
            'nomor_bukti_prestasi' => $request->nomor_bukti_prestasi,
            'file_bukti_prestasi' => $nama_file1,
        ]);

        $request->session()->flash('success', 'Data berhasil dibuat');

        return redirect()->route('mobile.prestasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function show(Prestasi $prestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestasi $prestasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestasi $prestasi)
    {
        //
    }
}
