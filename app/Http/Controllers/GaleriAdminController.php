<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Models\Acara;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GaleriAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $acara = Acara::all();
            $activeAcara = Acara::where('status_acara', 1)->first();

            $query = Galeri::query();

            if ($request->has('acara_id') && $request->acara_id != '') {
                // Apply filter by acara_id
                $query->where('acara_id', $request->acara_id);
            } else {
                // Apply default condition to filter by status_acara
                $query->whereHas('acara', function ($subQuery) {
                    $subQuery->where('status_acara', 1);
                });
            }

            $galeri = $query->with('acara')->paginate(20);

            return view('galeri.index', [
                'galeri' => $galeri,
                'acara' => $acara,
                'activeAcara' => $activeAcara,
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
        $acara = Acara::all();
        return view('galeri.create', [
            'acara' => $acara,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'acara_id' => 'required',
            'dokumentasi' => 'nullable|file|image|max:2048',
            'deskripsi' => 'nullable',
        ]);

        // Process and store the file if uploaded
        if ($request->hasFile('dokumentasi')) {
            $file1 = $request->file('dokumentasi');
            $date = date('dmY'); // Format the date as 'DDMMYYYY'
            $nama_file1 = 'esiaga_' . $date . '_' . $file1->getClientOriginalName(); // Combine 'esiaga', date, and original file name
            $tujuan_upload = 'dokumentasi';
            $file1->move($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }

        // Create Galeri instance with the validated data and file paths
        Galeri::create([
            'acara_id' => $request->acara_id,
            'dokumentasi' => $nama_file1, // Store the modified file name in the database
            'deskripsi' => $request->deskripsi,
        ]);

        $request->session()->flash('success', 'Data berhasil dibuat');

        return redirect()->route('galeri.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $galeri = Galeri::findOrFail($id);

        // Get the filename from the Lisensi model
        $filename = $galeri->foto_ijazah;

        // Check if the file exists before deleting
        if ($filename && File::exists(public_path('dokumentasi/' . $filename))) {
            File::delete(public_path('dokumentasi/' . $filename));
        }

        // Delete the Lisensi data from the database
        $galeri->delete();

        $request->session()->flash('danger', 'Data Lisensi telah dihapus');

        return redirect(route('galeri.index'));
    }
}
