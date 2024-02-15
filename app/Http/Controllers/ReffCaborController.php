<?php

namespace App\Http\Controllers;

use App\Models\ReffCabor;
use Illuminate\Http\Request;

class ReffCaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reffCabors = ReffCabor::paginate(10);
        return view('cabor.index', ['reffCabors' => $reffCabors]);
        //return view('cabor.index', compact('reffCabors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cabor.create');
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
            'nama_cabor' => 'required',
            'deskripsi_cabor' => 'nullable',
        ]);

        ReffCabor::create($validatedData);
        return redirect()->route('cabor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReffCabor  $reffCabor
     * @return \Illuminate\Http\Response
     */
    public function show(ReffCabor $reffCabor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffCabor  $reffCabor
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffCabor $reffCabor)
    {
        return view('cabor.edit', compact('reffCabor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffCabor  $reffCabor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffCabor $reffCabor)
    {
        $validatedData = $request->validate([
            'nama_cabor' => 'required',
            'deskripsi_cabor' => 'nullable',
        ]);

        $reffCabor->update($validatedData);
        return redirect()->route('cabor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffCabor  $reffCabor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ReffCabor $reffCabor)
    {
        ReffCabor::destroy($id);

        return redirect()->route('cabor.index');
    }
}
