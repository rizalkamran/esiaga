<?php

namespace App\Http\Controllers;

use App\Models\Lisensi;
use App\Models\ReffCabor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class LisensiAdminController extends Controller
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
            $query = Lisensi::query();

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
            $lisensi = $query->paginate(10);

            return view('lisensi.index', ['lisensi' => $lisensi, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
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
            $cabor = ReffCabor::all();

            return view('lisensi.create', [
                'user' => $user,
                'cabor' => $cabor,
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

        $request->session()->flash('success', 'Data lisensi dibuat');

        return redirect()->route('lisensi.index');
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
    public function edit($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $lisensi = Lisensi::findOrFail($id);
            $cabor = ReffCabor::all();

            return view('lisensi.edit', [
                'lisensi' => $lisensi,
                'cabor' => $cabor,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lisensi  $lisensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = auth()->user()->name;

        $request->validate([
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

        // Find the lisensi entry by its ID
        $lisensi = Lisensi::findOrFail($id);

        // Update the lisensi entry with the validated data from the request
        $lisensi->update($request->all());

        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('foto_lisensi')) {
            $file1 = $request->file('foto_lisensi');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'foto_lisensi';

            // Delete the old file if it exists
            if ($lisensi->foto_lisensi) {
                $oldFilePath = public_path($tujuan_upload . '/' . $lisensi->foto_lisensi);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $lisensi->foto_lisensi = null;
                    $lisensi->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $lisensi->foto_lisensi = $nama_file1;
        }

        $lisensi->save();
        $request->session()->flash('success', 'Data lisensi diupdate');

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('lisensi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lisensi  $lisensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $lisensi = Lisensi::findOrFail($id);

        // Get the filename from the Lisensi model
        $filename = $lisensi->foto_lisensi;

        // Check if the file exists before deleting
        if ($filename && File::exists(public_path('foto_lisensi/' . $filename))) {
            File::delete(public_path('foto_lisensi/' . $filename));
        }

        // Delete the Lisensi data from the database
        $lisensi->delete();

        $request->session()->flash('danger', 'Data Lisensi telah dihapus');

        return redirect(route('lisensi.index'));
    }
}
