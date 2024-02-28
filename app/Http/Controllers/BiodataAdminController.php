<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\ReffCabor;
use App\Models\User;
use App\Models\ReffProvinsi;
use App\Models\ReffKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BiodataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-admin')) {
            $biodata = Biodata::paginate(10);
            return view('biodata_admin.index', ['biodata' => $biodata]);
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
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('is-admin')) {
            $biodata = Biodata::findOrFail($id);
            $kota = ReffKota::all();
            $cabor = ReffCabor::all();

            return view('biodata_admin.edit', [
                'biodata' => $biodata,
                'kota' => $kota,
                'cabor' => $cabor,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            //'user_id' => 'required',
            //'provinsi_id' => 'required',
            'kota_id' => 'required',
            'cabor_id' => 'required',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string',
            'nip_asn' => 'nullable|numeric',
            'npwp' => 'nullable|numeric',
            'alamat_jalan' => 'nullable|string',
            'alamat_rt' => 'nullable|string',
            'alamat_rw' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'gol_darah' => 'nullable|string',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|integer',
            'status_menikah' => 'nullable|string',
            'hobi' => 'nullable|string',
            'foto_diri' => 'nullable|file|image|max:2048',
            'foto_ktp' => 'nullable|file|image|max:2048',
            'foto_npwp' => 'nullable|file|image|max:2048',
        ]);

        // Find the biodata entry by its ID
        $biodata = Biodata::findOrFail($id);

        // Update the biodata entry with the validated data from the request
        $biodata->update($request->all());

        // Process and store the first file if uploaded
        if ($request->hasFile('foto_diri')) {
            $file1 = $request->file('foto_diri');
            $nama_file1 = auth()->user()->name . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'foto_diri';
            $file1->storeAs($tujuan_upload, $nama_file1);
            $biodata->foto_diri = $nama_file1;
        }

        // Process and store the second file if uploaded
        if ($request->hasFile('foto_ktp')) {
            $file2 = $request->file('foto_ktp');
            $nama_file2 = auth()->user()->name . '_' . $file2->getClientOriginalName();
            $tujuan_upload2 = 'foto_ktp';
            $file2->storeAs($tujuan_upload2, $nama_file2);
            $biodata->foto_ktp = $nama_file2;
        }

        // Process and store the third file if uploaded
        if ($request->hasFile('foto_npwp')) {
            $file3 = $request->file('foto_npwp');
            $nama_file3 = auth()->user()->name . '_' . $file3->getClientOriginalName();
            $tujuan_upload3 = 'foto_npwp';
            $file3->storeAs($tujuan_upload3, $nama_file3);
            $biodata->foto_npwp = $nama_file3;
        }

        // Save the updated biodata entry with file paths
        $biodata->save();

        // Redirect the user to the index page or any other appropriate page
        return redirect()->route('biodata_admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}
