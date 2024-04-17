<?php

namespace App\Http\Controllers;

use App\Models\ReffPendidikan;
use Illuminate\Http\Request;

class ReffPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reffdidik = ReffPendidikan::paginate(10);
        return view('reffdidik.index', compact('reffdidik'));
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
     * @param  \App\Models\ReffPendidikan  $reffPendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(ReffPendidikan $reffPendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffPendidikan  $reffPendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffPendidikan $reffPendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffPendidikan  $reffPendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffPendidikan $reffPendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffPendidikan  $reffPendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReffPendidikan $reffPendidikan)
    {
        //
    }
}
