<?php

namespace App\Http\Controllers;

use App\Models\ReffPemenang;
use Illuminate\Http\Request;

class ReffPemenangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reffPemenang = ReffPemenang::paginate(10);
        return view('reff_pemenang.index', compact('reffPemenang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reff_pemenang.create');
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
            'deskripsi' => 'required',
        ]);

        ReffPemenang::create($validatedData);
        return redirect()->route('reff_pemenang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReffPemenang  $reffPemenang
     * @return \Illuminate\Http\Response
     */
    public function show(ReffPemenang $reffPemenang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffPemenang  $reffPemenang
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffPemenang $reffPemenang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffPemenang  $reffPemenang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffPemenang $reffPemenang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffPemenang  $reffPemenang
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReffPemenang $reffPemenang)
    {
        //
    }
}
