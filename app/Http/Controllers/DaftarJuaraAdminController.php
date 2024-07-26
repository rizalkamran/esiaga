<?php

namespace App\Http\Controllers;

use App\Models\DaftarJuara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Acara;
use App\Models\Kategori;
use App\Models\User;

class DaftarJuaraAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $acara = Acara::where('tipe', 2)->get();
            $activeAcara = Acara::where('status_acara', 1)->first();

            $query = DaftarJuara::query();

            if ($request->has('acara_id') && $request->acara_id != '') {
                // Apply filter by acara_id
                $query->whereHas('kategori.acara', function($q) use ($request) {
                    $q->where('id', $request->acara_id);
                });
            } else {
                // Apply default condition to filter by status_acara
                $query->whereHas('kategori.acara', function ($subQuery) {
                    $subQuery->where('status_acara', 1);
                });
            }

            if ($request->has('nama_lengkap') && $request->nama_lengkap != '') {
                // Apply filter by nama_lengkap
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
                });
            }

            $daftarjuara = $query->paginate(25);

            return view('daftar_juara.index', [
                'daftarjuara' => $daftarjuara,
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
        $users = User::all();

        // Retrieve all Kategori to populate dropdown/select
        $kategori = Kategori::all();
        $acara = Acara::where('tipe', 2)->get();

        return view('daftar_juara.create', [
            'users' => $users,
            'kategori' => $kategori,
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
            'user_id' => 'required',
            'kategori_id' => 'required',
            'status_juara' => 'required',
        ]);

        // Create a new attendance record
        DaftarJuara::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarJuara  $daftarJuara
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarJuara $daftarJuara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarJuara  $daftarJuara
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $kategori = Kategori::all();
        $acara = Acara::where('tipe', 2)->get();

        $daftarjuara = DaftarJuara::findOrFail($id);

        return view('daftar_juara.edit', [
            'users' => $users,
            'kategori' => $kategori,
            'acara' => $acara,
            'daftarjuara' => $daftarjuara,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarJuara  $daftarJuara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validate the request data
        $request->validate([
            'user_id' => 'required',
            'kategori_id' => 'required',
            'status_juara' => 'required',
        ]);

        $daftarjuara = DaftarJuara::findOrFail($id);
        // Update the lisensi entry with the validated data from the request
        $daftarjuara->update($request->all());

        $request->session()->flash('success', 'Data kategori diupdate');

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('daftar_juara.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarJuara  $daftarJuara
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DaftarJuara::destroy($id);

        return redirect()->route('daftar_juara.index')->with('danger', 'Data Acara berhasil dihapus');
    }
}
