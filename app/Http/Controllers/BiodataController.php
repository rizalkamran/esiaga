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
        if (Gate::allows('is-non-publik')) {

            if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false) {
                $biodata = Biodata::where('user_id', auth()->user()->id)->get(); // Change 10 to the desired number of items per page
                return view('mobile.biodata.index', ['biodata' => $biodata]);
            }
        } else{
            if (Gate::allows('is-admin')) {
                $biodata = Biodata::paginate(10);
                return view('biodata.index', ['biodata' => $biodata]);
            }
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
        if (Gate::allows('is-non-publik')) {
            // Get the authenticated user's ID
            $user_id = auth()->user()->id;

            //$provinsi = ReffProvinsi::all();
            $kota = ReffKota::all();

            return view('mobile.biodata.create', [
                'user_id' => $user_id,
                //'provinsi' => $provinsi,
                'kota' => $kota
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    public function getKota($provinsiId)
    {
        $kota = ReffKota::where('provinsi_id', $provinsiId)->get();
        return response()->json($kota);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $username = auth()->user()->name;

        $request->validate([
            'user_id' => 'required',
            //'provinsi_id' => 'required',
            'kota_id' => 'required',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'nip_asn' => 'required|string|size:18',
            'npwp' => 'required|string|size:16',
            'alamat_jalan' => 'required|string',
            'alamat_rt' => 'required|string',
            'alamat_rw' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'gol_darah' => 'required|string',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|integer',
            'status_menikah' => 'required|string',
            'hobi' => 'required|string',
            'foto_diri' => 'nullable|file|image|max:1024',
            'foto_ktp' => 'nullable|file|image|max:1024',
            'foto_npwp' => 'nullable|file|image|max:1024',
            'status_anggota' => 'nullable|integer',
            'request_role' => 'nullable|integer',
        ]);

        // Process and store the first file if uploaded
        if ($request->hasFile('foto_diri')) {
            $file1 = $request->file('foto_diri');
            $nama_file1 = $username . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'foto_diri';
            $file1->storeAs($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }

        // Process and store the second file if uploaded
        if ($request->hasFile('foto_ktp')) {
            $file2 = $request->file('foto_ktp');
            $nama_file2 = $username . '_' . $file2->getClientOriginalName();
            $tujuan_upload2 = 'foto_ktp';
            $file2->storeAs($tujuan_upload2, $nama_file2);
        } else {
            $nama_file2 = null; // or whatever default value you want to set
        }

        // Process and store the third file if uploaded
        if ($request->hasFile('foto_npwp')) {
            $file3 = $request->file('foto_npwp');
            $nama_file3 = $username . '_' . $file3->getClientOriginalName();
            $tujuan_upload3 = 'foto_npwp';
            $file3->storeAs($tujuan_upload3, $nama_file3);
        } else {
            $nama_file3 = null; // or whatever default value you want to set
        }

        // Create Biodata instance with the validated data and file paths
        Biodata::create([
            'user_id' => $request->user_id,
            //'provinsi_id' => $request->provinsi_id,
            'kota_id' => $request->kota_id,
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
            'gol_darah' => $request->gol_darah,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'status_menikah' => $request->status_menikah,
            'hobi' => $request->hobi,
            'foto_diri' => $nama_file1,
            'foto_ktp' => $nama_file2,
            'foto_npwp' => $nama_file3,
            'status_anggota' => $request->status_anggota,
            'request_role' => $request->request_role,
        ]);

        return redirect()->route('mobile.biodata.index');
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
    public function edit($id)
    {
        if (Gate::allows('is-non-publik')) {
            $biodata = Biodata::findOrFail($id);
            $kota = ReffKota::all();

            return view('mobile.biodata.edit', [
                'biodata' => $biodata,
                'kota' => $kota
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
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'nip_asn' => 'required|string|size:18',
            'npwp' => 'required|string|size:16',
            'alamat_jalan' => 'required|string',
            'alamat_rt' => 'required|string',
            'alamat_rw' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'gol_darah' => 'required|string',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|integer',
            'status_menikah' => 'required|string',
            'hobi' => 'required|string',
            'foto_diri' => 'nullable|file|image|max:1024',
            'foto_ktp' => 'nullable|file|image|max:1024',
            'foto_npwp' => 'nullable|file|image|max:1024',
            'status_anggota' => 'nullable|integer',
            'request_role' => 'nullable|integer',
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
        return redirect()->route('mobile.biodata.index');
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
