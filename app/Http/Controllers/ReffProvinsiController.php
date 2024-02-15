<?php

namespace App\Http\Controllers;

use App\Models\ReffProvinsi;
use Illuminate\Http\Request;

class ReffProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reffProvinsi = ReffProvinsi::paginate(10); // Change 10 to the number of items you want per page
        return view('data-provinsi.index', ['reffProvinsi' => $reffProvinsi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReffProvinsi  $reffProvinsi
     * @return \Illuminate\Http\Response
     */
    public function show(ReffProvinsi $reffProvinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffProvinsi  $reffProvinsi
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffProvinsi $reffProvinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffProvinsi  $reffProvinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffProvinsi $reffProvinsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffProvinsi  $reffProvinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReffProvinsi $reffProvinsi)
    {
        //
    }
}
