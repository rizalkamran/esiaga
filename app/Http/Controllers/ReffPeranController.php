<?php

namespace App\Http\Controllers;

use App\Models\ReffPeran;
use Illuminate\Http\Request;

class ReffPeranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reffPerans = ReffPeran::paginate(10);
        return view('peran.index', compact('reffPerans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peran.create');
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
            'nama_peran' => 'required',
        ]);

        ReffPeran::create($validatedData);
        return redirect()->route('peran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReffPeran  $reffPeran
     * @return \Illuminate\Http\Response
     */
    public function show(ReffPeran $reffPeran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffPeran  $reffPeran
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffPeran $reffPeran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffPeran  $reffPeran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffPeran $reffPeran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffPeran  $reffPeran
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReffPeran $reffPeran)
    {
        //
    }
}
