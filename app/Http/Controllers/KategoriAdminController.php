<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Acara;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KategoriAdminController extends Controller
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
            $query = Kategori::query();

            if ($request->has('acara_id') && $request->acara_id != '') {
                // Apply filter by acara_id
                $query->where('acara_id', $request->acara_id);
            } else {
                // Apply default condition to filter by status_acara
                $query->whereHas('acara', function ($subQuery) {
                    $subQuery->where('status_acara', 1);
                });
            }

            $kategori = $query->with('acara')->paginate(25);

            return view('kategori.index', [
                'kategori' => $kategori,
                'acara' => $acara,
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
        $acara = Acara::where('tipe', 2)->get();
        return view('kategori.create', [
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
            'parent' => 'nullable',
            'nama_kategori' => 'required',
            'desk_tambahan' => 'nullable',
        ]);

        // Create a new attendance record
        Kategori::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
