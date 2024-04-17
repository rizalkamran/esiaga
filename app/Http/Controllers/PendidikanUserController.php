<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReffPendidikan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PendidikanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-non-publik')) {

            if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false) {
                $pendidikan = Pendidikan::where('user_id', auth()->user()->id)->get(); // Change 10 to the desired number of items per page
                return view('mobile.pendidikan.index', ['pendidikan' => $pendidikan]);
            }
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
            $reff = ReffPendidikan::all();

            return view('mobile.pendidikan.create', [
                'user_id' => $user_id,
                'reff' => $reff,
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
            'pendidikan_id' => 'required',
            'gelar_depan' => 'nullable|string',
            'gelar_belakang' => 'nullable|string',
            'nama_sekolah' => 'required|string',
            'nama_jurusan' => 'required|string',
            'tahun_lulus' => 'required|date_format:Y',
            'ijazah' => 'nullable|file|image|max:1024',
        ]);

        // Process and store the first file if uploaded
        if ($request->hasFile('ijazah')) {
            $file1 = $request->file('ijazah');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName(); // Appending timestamp
            $tujuan_upload = 'ijazah';
            $file1->move($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }


        // Create Biodata instance with the validated data and file paths
        Pendidikan::create([
            'user_id' => $request->user_id,
            'pendidikan_id' => $request->pendidikan_id,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'nama_sekolah' => $request->nama_sekolah,
            'nama_jurusan' => $request->nama_jurusan,
            'tahun_lulus' => $request->tahun_lulus,
            'ijazah' => $nama_file1,
        ]);

        $request->session()->flash('success', 'Data berhasil dibuat');

        return redirect()->route('mobile.pendidikan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendidikan $pendidikan)
    {
        //
    }
}
