<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PekerjaanAdminController extends Controller
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
            $query = Pekerjaan::query();

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
            $pekerjaan = $query->paginate(10);

            return view('pekerjaan.index', ['pekerjaan' => $pekerjaan, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
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

            return view('pekerjaan.create', [
                'user' => $user,
                'user_id' => $userId,
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

        $request->session()->flash('success', 'Data pekerjaan dibuat');

        return redirect()->route('pekerjaan.index');
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
    public function edit($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $pekerjaan = Pekerjaan::findOrFail($id);

            return view('pekerjaan.edit', [
                'pekerjaan' => $pekerjaan,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $username = auth()->user()->name;

        $request->validate([
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

        // Find the lisensi entry by its ID
        $pekerjaan = Pekerjaan::findOrFail($id);

        // Update the pekerjaan entry with the validated data from the request
        $pekerjaan->update($request->all());

        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('bukti_kerja')) {
            $file1 = $request->file('bukti_kerja');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'bukti_kerja';

            // Delete the old file if it exists
            if ($pekerjaan->bukti_kerja) {
                $oldFilePath = public_path($tujuan_upload . '/' . $pekerjaan->bukti_kerja);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $pekerjaan->bukti_kerja = null;
                    $pekerjaan->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $pekerjaan->bukti_kerja = $nama_file1;
        }

        $pekerjaan->save();
        $request->session()->flash('success', 'Data pekerjaan diupdate');

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('pekerjaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);

        // Get the filename from the Lisensi model
        $filename = $pekerjaan->bukti_kerja;

        // Check if the file exists before deleting
        if ($filename && File::exists(public_path('bukti_kerja/' . $filename))) {
            File::delete(public_path('bukti_kerja/' . $filename));
        }

        // Delete the Lisensi data from the database
        $pekerjaan->delete();

        $request->session()->flash('danger', 'Data Lisensi telah dihapus');

        return redirect(route('pekerjaan.index'));
    }
}
