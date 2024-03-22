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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BiodataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin')) {
            $searchQuery = $request->input('search');

            // Start with the base query
            $query = Biodata::query();

            // Filter by search query
            if ($searchQuery) {
                $query->whereHas('user', function ($q) use ($searchQuery) {
                    $q->where('nama_lengkap', 'like', '%' . $searchQuery . '%');
                })->orWhereHas('cabor', function ($q) use ($searchQuery) {
                    $q->where('nama_cabor', 'like', '%' . $searchQuery . '%');
                });
            }

            // Apply sorting
            $sortField = $request->input('sort_by', 'id'); // Default sort by ID
            $sortOrder = $request->input('sort_order', 'asc'); // Default sort order is ascending

            // Ensure valid sort fields
            $sortableFields = ['nama_lengkap', 'nama_cabor', 'jenis_kelamin'];

            if (in_array($sortField, $sortableFields)) {
                if ($sortField === 'nama_lengkap') {
                    // Use subquery to sort by nama_lengkap from the related user
                    $query->orderBy(function ($query) use ($sortOrder) {
                        $query->select('nama_lengkap')
                            ->from('users')
                            ->whereColumn('users.id', 'biodata.user_id')
                            ->orderBy('nama_lengkap', $sortOrder) // Updated to include sort order
                            ->limit(1);
                    });
                } elseif ($sortField === 'nama_cabor') {
                    // Sort by cabor_id while displaying it as nama_cabor
                    $query->select('biodata.*')->orderBy('cabor_id', $sortOrder);
                } else {
                    // Sort by other fields directly in the Biodata table
                    $query->orderBy($sortField, $sortOrder);
                }
            }

            // Paginate the search results
            $biodata = $query->paginate(10);

            return view('biodata_admin.index', [
                'biodata' => $biodata,
                'searchQuery' => $searchQuery,
                'sortField' => $sortField,
                'sortOrder' => $sortOrder,
            ]);
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
            //'kota_id' => 'required',
            //'cabor_id' => 'required',
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


        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('foto_diri')) {
            $file1 = $request->file('foto_diri');
            $nama_file1 = auth()->user()->name . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'biodata/foto_diri';

            // Delete the old file if it exists
            if ($biodata->foto_diri) {
                $oldFilePath = public_path($tujuan_upload . '/' . $biodata->foto_diri);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $biodata->foto_diri = null;
                    $biodata->save();
                }
            }

            // Move the new file to the destination folder
            $file1->move($tujuan_upload, $nama_file1);
            $biodata->foto_diri = $nama_file1;
        }

        // Process and store the second file if uploaded
        if ($request->hasFile('foto_ktp')) {
            $file2 = $request->file('foto_ktp');
            $nama_file2 = auth()->user()->name . '_' . $file2->getClientOriginalName();
            $tujuan_upload2 = 'biodata/foto_ktp';

            // Delete the old file if it exists
            if ($biodata->foto_ktp) {
                $oldFilePath = public_path($tujuan_upload2 . '/' . $biodata->foto_ktp);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $biodata->foto_ktp = null;
                    $biodata->save();
                }
            }

            // Move the new file to the destination folder
            $file2->move($tujuan_upload2, $nama_file2);
            $biodata->foto_ktp = $nama_file2;
        }

        // Process and store the third file if uploaded
        if ($request->hasFile('foto_npwp')) {
            $file3 = $request->file('foto_npwp');
            $nama_file3 = auth()->user()->name . '_' . $file3->getClientOriginalName();
            $tujuan_upload3 = 'biodata/foto_npwp';

            // Delete the old file if it exists
            if ($biodata->foto_npwp) {
                $oldFilePath = public_path($tujuan_upload3 . '/' . $biodata->foto_npwp);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                    // Also remove the old file name from the database
                    $biodata->foto_npwp = null;
                    $biodata->save();
                }
            }

            // Move the new file to the destination folder
            $file3->move($tujuan_upload3, $nama_file3);
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
