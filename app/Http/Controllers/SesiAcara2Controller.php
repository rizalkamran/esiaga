<?php

namespace App\Http\Controllers;

use App\Models\SesiAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Acara;

class SesiAcara2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            // Fetch all Acara for the dropdown where tipe is 1
            $acaraList = Acara::where('tipe', 2)->get();

            $query = SesiAcara::query();

            // Apply the filter if 'acara_id' is present
            if ($request->has('acara_id') && !empty($request->query('acara_id'))) {
                $acaraId = $request->query('acara_id');
                $query->where('acara_id', $acaraId);
            } else {
                // Ensure only SesiAcara with Acara.status_acara = 1 and Acara.tipe = 1 are shown when no filter is applied
                $query->whereHas('acara', function ($subQuery) {
                    $subQuery->where('status_acara', 1)
                            ->where('tipe', 2);
                });
            }

            $sesi = $query->with('acara')->paginate(25);

            return view('sesi_acara2.index', ['sesi' => $sesi, 'acaraList' => $acaraList]);
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

            return view('sesi_acara2.create', [
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

        return redirect()->route('sesi_acara2.index')->with('success', 'Data Acara berhasil dibuat');
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
