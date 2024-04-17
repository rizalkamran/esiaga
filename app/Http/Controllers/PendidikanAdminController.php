<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReffPendidikan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PendidikanAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {

            $userId = $request->input('user_id');
            $searchQuery = $request->input('search');

            // Start with the base query
            $query = Pendidikan::query();

            if ($userId) {
                $query->where('user_id', $userId);
            }

            // Filter by search query
            if ($searchQuery) {
                $query->whereHas('user', function ($q) use ($searchQuery) {
                    $q->where('nama_lengkap', 'like', '%' . $searchQuery . '%');
                });
            }

            // Paginate the search results
            $pendidikan = $query->paginate(10);

            return view('pendidikan.index', ['pendidikan' => $pendidikan, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Get the authenticated user's ID
            $userId = $request->input('user_id');

            // Get the user list based on the presence of the user_id parameter
            if ($userId) {
                $user = User::where('id', $userId)->get();
            } else {
                $user = User::all();
            }

            $reff = ReffPendidikan::all();

            return view('pendidikan.create', [
                'user' => $user,
                'user_id' => $userId,
                'reff' => $reff,
            ]);
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

        return redirect()->route('pendidikan.index');
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
    public function edit($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $pendidikan = Pendidikan::findOrFail($id);

            $reff = ReffPendidikan::all();

            return view('pendidikan.edit', [
                'pendidikan' => $pendidikan,
                'reff' => $reff,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = auth()->user()->name;

        $request->validate([
            'pendidikan_id' => 'required',
            'gelar_depan' => 'nullable|string',
            'gelar_belakang' => 'nullable|string',
            'nama_sekolah' => 'required|string',
            'nama_jurusan' => 'required|string',
            'tahun_lulus' => 'required|date_format:Y',
            'ijazah' => 'nullable|file|image|max:1024',
        ]);

        // Find the lisensi entry by its ID
        $pendidikan = Pendidikan::findOrFail($id);

        // Update the lisensi entry with the validated data from the request
        $pendidikan->update($request->all());

        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('ijazah')) {
            $file1 = $request->file('ijazah');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'ijazah';

            // Delete the old file if it exists
            if ($pendidikan->ijazah) {
                $oldFilePath = public_path($tujuan_upload . '/' . $pendidikan->ijazah);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $pendidikan->ijazah = null;
                    $pendidikan->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $pendidikan->ijazah = $nama_file1;
        }

        $pendidikan->save();
        $request->session()->flash('success', 'Data pendidikan diupdate');

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('pendidikan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $pendidikan = Pendidikan::findOrFail($id);

        // Get the filename from the Lisensi model
        $filename = $pendidikan->ijazah;

        // Check if the file exists before deleting
        if ($filename && File::exists(public_path('ijazah/' . $filename))) {
            File::delete(public_path('ijazah/' . $filename));
        }

        // Delete the Lisensi data from the database
        $pendidikan->delete();

        $request->session()->flash('danger', 'Data Pendidikan telah dihapus');

        return redirect(route('pendidikan.index'));
    }
}
