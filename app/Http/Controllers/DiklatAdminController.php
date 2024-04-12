<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DiklatAdminController extends Controller
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
            $query = Diklat::query();

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
            $diklat = $query->paginate(10);

            return view('diklat.index', ['diklat' => $diklat, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
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
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Get the authenticated user's ID
            $user =  User::all();

            return view('diklat.create', [
                'user' => $user,
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
            $file1->move($tujuan_upload, $nama_file1);
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

        $request->session()->flash('success', 'Data berhasil dibuat');

        return redirect()->route('diklat.index');
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
    public function edit($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $diklat = Diklat::findOrFail($id);

            return view('diklat.edit', [
                'diklat' => $diklat,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = auth()->user()->name;

        $request->validate([
            'tingkat' => 'required|string',
            'nama_diklat' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'jumlah_jam' => 'required|integer',
            'penyelenggara' => 'required|string',
            'foto_ijazah' => 'nullable|file|image|max:1024',
        ]);

        // Find the lisensi entry by its ID
        $diklat = Diklat::findOrFail($id);

        // Update the lisensi entry with the validated data from the request
        $diklat->update($request->all());

        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('foto_ijazah')) {
            $file1 = $request->file('foto_ijazah');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'foto_ijazah';

            // Delete the old file if it exists
            if ($diklat->foto_ijazah) {
                $oldFilePath = public_path($tujuan_upload . '/' . $diklat->foto_ijazah);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $diklat->foto_ijazah = null;
                    $diklat->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $diklat->foto_ijazah = $nama_file1;
        }

        $diklat->save();
        $request->session()->flash('success', 'Data diklat diupdate');

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('diklat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $diklat = Diklat::findOrFail($id);

        // Get the filename from the Lisensi model
        $filename = $diklat->foto_ijazah;

        // Check if the file exists before deleting
        if ($filename && File::exists(public_path('foto_ijazah/' . $filename))) {
            File::delete(public_path('foto_ijazah/' . $filename));
        }

        // Delete the Lisensi data from the database
        $diklat->delete();

        $request->session()->flash('danger', 'Data Lisensi telah dihapus');

        return redirect(route('diklat.index'));
    }
}
