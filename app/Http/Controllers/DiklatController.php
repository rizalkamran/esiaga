<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
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
                $diklat = Diklat::where('user_id', auth()->user()->id)->get(); // Change 10 to the desired number of items per page
                return view('mobile.diklat.index', ['diklat' => $diklat]);
            }
        } else {
            if (Gate::allows('is-admin')) {
                $diklat = Diklat::paginate(10);
                return view('diklat.index', ['diklat' => $diklat]);
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

            return view('mobile.diklat.create', [
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
        $username = auth()->user()->name;

        $request->validate([
            'user_id' => 'required',
            'tingkat' => 'required|string',
            'nama_diklat' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'jumlah_jam' => 'required|integer',
            'penyelenggara' => 'required|string',
            'foto_ijazah' => 'nullable|file|image|max:1024',
        ]);

        // Process and store the first file if uploaded
        if ($request->hasFile('foto_ijazah')) {
            $file1 = $request->file('foto_ijazah');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName(); // Appending timestamp
            $tujuan_upload = 'foto_ijazah';
            $file1->storeAs($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }


        // Create Biodata instance with the validated data and file paths
        Diklat::create([
            'user_id' => $request->user_id,
            'tingkat' => $request->tingkat,
            'nama_diklat' => $request->nama_diklat,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'jumlah_jam' => $request->jumlah_jam,
            'penyelenggara' => $request->penyelenggara,
            'foto_ijazah' => $nama_file1,
        ]);

        return redirect()->route('mobile.diklat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function show(Diklat $diklat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function edit(Diklat $diklat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diklat $diklat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diklat $diklat)
    {
        //
    }
}
