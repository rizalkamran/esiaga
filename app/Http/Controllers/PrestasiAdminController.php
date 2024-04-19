<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use App\Models\ReffCabor;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PrestasiAdminController extends Controller
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
            $query = Prestasi::query();

            if ($userId) {
                $query->where('user_id', $userId);
            }

            // Filter by search query
            if ($searchQuery) {
                $query->whereHas('user', function ($q) use ($searchQuery) {
                    $q->where('nama_lengkap', 'like', '%' . $searchQuery . '%');
                })->orWhereHas('cabor', function ($q) use ($searchQuery) {
                    $q->where('nama_cabor', 'like', '%' . $searchQuery . '%');
                })->orWhere(function ($q) use ($searchQuery) {
                    $q->where('tipe_prestasi', 'like', '%' . $searchQuery . '%')
                        ->orWhere('tahun', 'like', '%' . $searchQuery . '%');
                });
            }

            // Paginate the search results
            $prestasi = $query->paginate(10);

            return view('prestasi.index', ['prestasi' => $prestasi, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
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

            $cabor = ReffCabor::all();

            return view('prestasi.create', [
                'user' => $user,
                'user_id' => $userId,
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

        return redirect()->route('prestasi.index');
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
    public function edit($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $prestasi = Prestasi::findOrFail($id);
            $cabor = ReffCabor::all();

            return view('prestasi.edit', [
                'prestasi' => $prestasi,
                'cabor' => $cabor,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = auth()->user()->name;

        $request->validate([
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

        // Find the prestasi entry by its ID
        $prestasi = Prestasi::findOrFail($id);

        // Update the prestasi entry with the validated data from the request
        $prestasi->update($request->all());

        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('file_bukti_prestasi')) {
            $file1 = $request->file('file_bukti_prestasi');
            $nama_file1 = $username . '_' . time() . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'file_bukti_prestasi';

            // Delete the old file if it exists
            if ($prestasi->file_bukti_prestasi) {
                $oldFilePath = public_path($tujuan_upload . '/' . $prestasi->file_bukti_prestasi);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $prestasi->file_bukti_prestasi = null;
                    $prestasi->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $prestasi->file_bukti_prestasi = $nama_file1;
        }

        $prestasi->save();
        $request->session()->flash('success', 'Data prestasi diupdate');

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('prestasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Get the filename from the Prestasi model
        $filename = $prestasi->file_bukti_prestasi;

        // Check if the file exists before deleting
        if ($filename && File::exists(public_path('file_bukti_prestasi/' . $filename))) {
            File::delete(public_path('file_bukti_prestasi/' . $filename));
        }

        // Delete the Prestasi data from the database
        $prestasi->delete();

        $request->session()->flash('danger', 'Data Prestasi telah dihapus');

        return redirect(route('prestasi.index'));
    }
}
