<?php

namespace App\Http\Controllers;

use App\Models\SesiAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Acara;

class SesiAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-admin')){
            $sesi = SesiAcara::with('acara')->paginate(10); // Eager load the 'acara' relationship
            return view('sesi_acara.index', ['sesi' => $sesi]);
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
        if (Gate::allows('is-admin')) {
            $acara = Acara::all();

            return view('sesi_acara.create', [
                'acara' => $acara,
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
        $validatedData = $request->validate([
            'acara_id' => 'required',
            'sesi' => 'required',
        ]);

        SesiAcara::create($validatedData);

        return redirect()->route('sesi_acara.index')->with('success', 'Data Acara berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SesiAcara  $sesiAcara
     * @return \Illuminate\Http\Response
     */
    public function show(SesiAcara $sesiAcara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SesiAcara  $sesiAcara
     * @return \Illuminate\Http\Response
     */
    public function edit(SesiAcara $sesiAcara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SesiAcara  $sesiAcara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SesiAcara $sesiAcara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SesiAcara  $sesiAcara
     * @return \Illuminate\Http\Response
     */
    public function destroy(SesiAcara $sesiAcara)
    {
        //
    }
}
