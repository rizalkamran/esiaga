<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use App\Models\ReffProvinsi;
use App\Models\ReffKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('logged-in')) {

            $biodata = Biodata::where('user_id', auth()->user()->id)->paginate(10); // Change 10 to the desired number of items per page
            return view('biodata.index', ['biodata' => $biodata]);
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
        if (Gate::allows('logged-in')) {
            // Get the authenticated user's ID
            $user_id = auth()->user()->id;

            $provinsi = ReffProvinsi::all();
            $kota = ReffKota::all();

            return view('biodata.create', [
                'user_id' => $user_id,
                'provinsi' => $provinsi,
                'kota' => $kota
            ]);
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
        $username = auth()->user()->name;

            $request->validate([
                'user_id' => 'required',
                'provinsi_id' => 'required',
                'kota_id' => 'required',
                'telepon' => 'required|string',
                'tempat_lahir' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string',
                'nip_asn' => 'nullable|string',
                'npwp' => 'nullable|string',
                'alamat_jalan' => 'nullable|string',
                'alamat_rt' => 'nullable|string',
                'alamat_rw' => 'nullable|string',
                'kecamatan' => 'nullable|string',
                'kelurahan' => 'nullable|string',
                'foto_diri' => 'required|file|image',
                'foto_ktp' => 'required|file|image',
                'foto_npwp' => 'required|file|image',
                'status_anggota' => 'nullable|integer',
                'request_role' => 'nullable|integer',
            ]);

            //$biodataData = $request->except(['foto_diri', 'foto_ktp', 'foto_npwp']);

            // Process and store the first file
            $file1 = $request->file('foto_diri');
            $nama_file1 = $username . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'foto_diri';
            $file1->storeAs($tujuan_upload, $nama_file1);

            // Process and store the second file
            $file2 = $request->file('foto_ktp');
            $nama_file2 = $username . '_' . $file2->getClientOriginalName();
            $tujuan_upload2 = 'foto_ktp';
            $file2->storeAs($tujuan_upload2, $nama_file2);

            // Process and store the third file
            $file3 = $request->file('foto_npwp');
            $nama_file3 = $username . '_' . $file3->getClientOriginalName();
            $tujuan_upload3 = 'foto_npwp';
            $file3->storeAs($tujuan_upload3, $nama_file3);


            //dd($validatedData);

            // Create Biodata instance with the validated data
            // Create Biodata instance with the validated data and file paths
            Biodata::create([
                'user_id' => $request->user_id,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'telepon' => $request->telepon,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'nip_asn' => $request->nip_asn,
                'npwp' => $request->npwp,
                'alamat_jalan' => $request->alamat_jalan,
                'alamat_rt' => $request->alamat_rt,
                'alamat_rw' => $request->alamat_rw,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'foto_diri' => $nama_file1,
                'foto_ktp' => $nama_file2,
                'foto_npwp' => $nama_file3,
                'status_anggota' => $request->status_anggota,
                'request_role' => $request->request_role,
            ]);

            return redirect()->route('biodata.index')->with('success', 'Biodata created successfully.');

    }

    /* public function downloadImage($imageName)
    {
        // Determine the path to the image file
        $path = storage_path('app/public/foto_diri/' . $imageName);

        // Check if the file exists
        if (file_exists($path)) {
            // Return the file as a download response
            return response()->download($path);
        } else {
            // Handle error if the file doesn't exist
            return response()->json(['error' => 'Image not found'], 404);
        }
    } */

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
    public function edit(Biodata $biodata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biodata $biodata)
    {
        //
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
