<?php

namespace App\Http\Controllers;

use App\Models\AnggotaAcaraRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Acara;
use Illuminate\Support\Facades\Auth;
use PDF;

class RegistrasiController extends Controller
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

        if (Gate::allows('is-non-publik')) {
            // Check if the request is coming from a mobile device
            if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false) {
                // If it's a mobile device, return the mobile view
                $anggota = AnggotaAcaraRegistrasi::where('user_id', auth()->user()->id)->get();
                return view('mobile.registrasi.index', ['anggota' => $anggota]);
            }
        }  else {
            // If it's not a mobile device, check if the user is an admin
            if (Gate::allows('is-admin')) {
                // Filter by acara if selected
                $query = AnggotaAcaraRegistrasi::query();
                if ($selectedAcara) {
                    $query->whereHas('acara', function ($q) use ($selectedAcara) {
                        $q->where('id', $selectedAcara);
                    });
                }
                $anggota = $query->paginate(10); // Paginate with * records per page
                return view('registrasi.index', ['anggota' => $anggota, 'acaraOptions' => $acaraOptions, 'selectedAcara' => $selectedAcara]);
            } else {
                // If the user is not an admin, return regular view for non-admin users
                $anggota = AnggotaAcaraRegistrasi::where('user_id', auth()->user()->id)->paginate(10);
                return view('registrasi.index', ['anggota' => $anggota, 'acaraOptions' => $acaraOptions, 'selectedAcara' => $selectedAcara]);
            }
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
        if (Gate::allows('is-non-publik')) {
            $acara = Acara::where('status_acara', 1)->get(); // Retrieve only active Acara records
            return view('mobile.registrasi.create', ['acara' => $acara]);
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve the currently logged-in user's ID
        $user_id = Auth::id();

        $request->validate([
            'acara_id' => ['required', 'exists:acara,id', 'not_registered_for_event'], // Validate that acara_id exists in the acara table
            'qrcode_registrasi' => 'nullable'
        ]);

        // Merge the user_id into the request data
        $requestData = array_merge($request->all(), ['user_id' => $user_id]);

        // Dump and die to inspect the request data before proceeding
        //dd($requestData);

        // Create a new instance of AnggotaAcaraRegistrasi and fill in the fields
        $anggotaAcaraRegistrasi = new AnggotaAcaraRegistrasi([
            'user_id' => $user_id,
            'acara_id' => $request->input('acara_id'),
            'qrcode_registrasi' => $request->input('qrcode_registrasi'),
        ]);

        // Save the instance to the database
        $anggotaAcaraRegistrasi->save();

        // Optionally, you can redirect the user to a different page after successful submission
        return redirect()->route('mobile.registrasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function show(AnggotaAcaraRegistrasi $anggotaAcaraRegistrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaAcaraRegistrasi $anggotaAcaraRegistrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggotaAcaraRegistrasi $anggotaAcaraRegistrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaAcaraRegistrasi  $anggotaAcaraRegistrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggotaAcaraRegistrasi $anggotaAcaraRegistrasi)
    {
        //
    }

    public function exportPDF(Request $request)
    {
        // Retrieve the 'acara' parameter from the request
        $selectedAcara = $request->input('acara');

        // Build your query based on conditions
        $query = AnggotaAcaraRegistrasi::query();

        // Apply the condition for 'acara_id'
        if ($selectedAcara) {
            $query->where('acara_id', $selectedAcara);
        }

        // Fetch data from the database based on the query
        $anggota = $query->get();

        // Load the view and pass data to it
        $pdf = PDF::loadView('registrasi.export-pdf', compact('anggota'));

        // Set paper orientation to landscape
        $pdf->setPaper('a4', 'landscape');

        // Stream the PDF to the browser
        return $pdf->stream('registrasi.pdf');
    }

}
