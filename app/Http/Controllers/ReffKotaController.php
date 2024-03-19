<?php

namespace App\Http\Controllers;

use App\Models\ReffKota;
use Illuminate\Http\Request;

class ReffKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ReffKota::query();

        $searchQuery = $request->query('search'); // Retrieve the search query

        if ($searchQuery) {
            $query->whereHas('provinsi', function ($query) use ($searchQuery) {
                $query->where('nama_provinsi', 'like', '%' . $searchQuery . '%');
            });
        }

        $reffKota = $query->simplePaginate(10); // Change 10 to the number of items you want per page

        return view('data-kota.index', [
            'reffKota' => $reffKota,
            'searchQuery' => $searchQuery, // Pass the search query to the view
        ]);
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
     * @param  \App\Models\ReffKota  $reffKota
     * @return \Illuminate\Http\Response
     */
    public function show(ReffKota $reffKota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReffKota  $reffKota
     * @return \Illuminate\Http\Response
     */
    public function edit(ReffKota $reffKota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReffKota  $reffKota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReffKota $reffKota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReffKota  $reffKota
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReffKota $reffKota)
    {
        //
    }
}
