<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PekerjaanAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {

            $userId = $request->input('user_id');
            $searchQuery = $request->input('search');

            // Start with the base query
            $query = Pekerjaan::query();

            if ($userId) {
                $query->where('user_id', $userId);
            }

            // Filter by search query
            if ($searchQuery) {
                $query->whereHas('user', function ($q) use ($searchQuery) {
                    $q->where('nama_lengkap', 'like', '%' . $searchQuery . '%');
                });
            }

            // Paginate the search results
            $pekerjaan = $query->paginate(10);

            return view('pekerjaan.index', ['pekerjaan' => $pekerjaan, 'searchQuery' => $searchQuery, 'user_id' => $userId]);
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
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        //
    }
}
