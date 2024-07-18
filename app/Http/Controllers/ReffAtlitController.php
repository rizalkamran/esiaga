<?php

namespace App\Http\Controllers;

use App\Models\ReffAtlit;
use App\Models\User;
use Illuminate\Http\Request;

class ReffAtlitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reffAtlit = ReffAtlit::paginate(10);
        return view('reff_atlit.index', compact('reffAtlit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('reff_atlit.create', [
            'users' => $users,
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
        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);

        ReffAtlit::create($validatedData);
        return redirect()->route('reff_atlit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReffAtlit  $reffAtlit
     * @return \Illuminate\Http\Response
     */
    public function show(ReffAtlit $reffAtlit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffAtlit  $reffAtlit
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffAtlit $reffAtlit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffAtlit  $reffAtlit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffAtlit $reffAtlit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffAtlit  $reffAtlit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReffAtlit $reffAtlit)
    {
        //
    }
}
