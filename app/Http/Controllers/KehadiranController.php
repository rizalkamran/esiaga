<?php

namespace App\Http\Controllers;
use App\Models\AnggotaKehadiranRegistrasi;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use PDF;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all acara options for the dropdown
        $acaraOptions = Acara::all();

        // Retrieve the selected acara (if any) from the request
        $selectedAcara = $request->input('acara');

        // Retrieve the selected date (if any) from the request
        $selectedDate = $request->input('date');

        // Check if the user is an admin
        if (Gate::allows('is-admin')) {
            // Filter by acara if selected
            $query = AnggotaKehadiranRegistrasi::query();
            if ($selectedAcara) {
                $query->whereHas('acara', function ($q) use ($selectedAcara) {
                    $q->where('id', $selectedAcara);
                });
            }

            // Filter by date if selected
            if ($selectedDate) {
                $query->whereDate('created_at', $selectedDate);
            }

            $kehadiran = $query->paginate(10); // Paginate with * records per page
            return view('kehadiran.index', ['kehadiran' => $kehadiran, 'acaraOptions' => $acaraOptions, 'selectedAcara' => $selectedAcara, 'selectedDate' => $selectedDate]);
        }

        // If the user is not authorized, return a 403 Forbidden error
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportPDF(Request $request)
    {
        // Retrieve the 'acara' and 'date' parameters from the request
        $selectedAcara = $request->input('acara');
        $selectedDate = $request->input('date');

        // Build your query based on conditions
        $query = AnggotaKehadiranRegistrasi::query();

        // Apply the condition for 'acara_id'
        if ($selectedAcara) {
            $query->where('acara_id', $selectedAcara);
        }

        // Apply the condition for 'created_at' date
        if ($selectedDate) {
            $query->whereDate('created_at', $selectedDate);
        }

        // Fetch data from the database based on the query
        $kehadiran = $query->get();

        // Load the view and pass data to it
        $pdf = PDF::loadView('kehadiran.export-pdf', compact('kehadiran'));

        // Stream the PDF to the browser
        return $pdf->stream('kehadiran.pdf');
    }

}
