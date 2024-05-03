<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPeran;
use App\Models\ReffCabor;
use App\Models\ReffPeran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnggotaPeranAdminController extends Controller
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
            $query = AnggotaPeran::query();

            if ($userId) {
                $query->where('user_id', $userId);
            }

            // Filter by search query
            if ($searchQuery) {
                $query->whereHas('user', function ($q) use ($searchQuery) {
                    $q->where('nama_lengkap', 'like', '%' . $searchQuery . '%');
                })->orWhereHas('peran', function ($q) use ($searchQuery) {
                    $q->where('nama_peran', 'like', '%' . $searchQuery . '%');
                })->orWhereHas('cabor', function ($q) use ($searchQuery) {
                    $q->where('nama_cabor', 'like', '%' . $searchQuery . '%');
                });
            }

            // Add orderBy created_at in descending order
            $query->orderBy('created_at', 'desc');

            // Paginate the search results
            $anggota_peran = $query->paginate(10);

            return view('anggota_peran.index', ['anggota_peran' => $anggota_peran, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
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
            $peran = ReffPeran::all();

            return view('anggota_peran.create', [
                'user' => $user,
                'cabor' => $cabor,
                'peran' => $peran,
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
        // Validate the form data...
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'peran_id' => 'required|integer',
            'cabor_id' => 'required|integer',
            'jabatan' => 'nullable|string|max:100',
            'nama_lembaga' => 'required|string|max:100',
            'provinsi_lembaga' => 'required|string|max:30',
            'kota_lembaga' => 'required|string|max:30',
            'kecamatan_lembaga' => 'required|string|max:30',
        ]);

        // Set default values for status_aktif_peran and status_verifikasi_peran
        $validatedData['status_aktif_peran'] = true;
        $validatedData['status_verifikasi_peran'] = false;

        // Dump and die to inspect the validated data
        //dd($validatedData);

        // Create a new AnggotaPeran instance with the form data
        AnggotaPeran::create($validatedData);

        // Redirect or do something else...
        return redirect()->route('anggota_peran.index')->with('success', 'Data Berhasil dibuat, harap menunggu verifikasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function show(AnggotaPeran $anggotaPeran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ensure that the user is authorized to edit
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Retrieve the AnggotaPeran instance by its ID
            $anggota_peran = AnggotaPeran::findOrFail($id);

            // Retrieve any necessary data for the view
            $peran = ReffPeran::all();
            $cabor = ReffCabor::all();

            // Pass the retrieved data to the view
            return view('anggota_peran.edit', [
                'anggota_peran' => $anggota_peran,
                'peran' => $peran,
                'cabor' => $cabor,
                // Add any other data you need in the view
            ]);
        }

        // If the user is not authorized, return a 403 Forbidden error
        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            //'user_id' => 'required',
            'peran_id' => 'required',
            'cabor_id' => 'required',
            'jabatan' => 'nullable|string',
            'nama_lembaga' => 'nullable|string',
            'provinsi_lembaga' => 'nullable|string',
            'kota_lembaga' => 'nullable|string',
            'kecamatan_lembaga' => 'nullable|string',
        ]);

        // Find the biodata entry by its ID
        $anggota = AnggotaPeran::findOrFail($id);

        // Update the biodata entry with the validated data from the request
        $anggota->update($request->all());

        // Save the updated biodata entry with file paths
        $anggota->save();

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('anggota_peran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaPeran  $anggotaPeran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $anggota_peran = AnggotaPeran::findOrFail($id);

        // Delete the data from the database
        $anggota_peran->delete();

        $request->session()->flash('danger', 'Data telah dihapus');

        return redirect(route('anggota_peran.index'));
    }
}
