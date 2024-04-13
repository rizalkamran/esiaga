<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\ReffCabor;
use App\Models\User;
use App\Models\ReffProvinsi;
use App\Models\ReffKota;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BiodataStafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-staf')) {
            $userId = $request->input('user_id');
            $searchQuery = $request->input('search');

            // Start with the base query
            $query = Biodata::query();

            if ($userId) {
                $query->where('user_id', $userId);
            }

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

            return view('staf.biodata.index', [
                'biodata' => $biodata,
                'searchQuery' => $searchQuery,
                'sortField' => $sortField,
                'sortOrder' => $sortOrder,
                'user_id' => $userId,
            ]);
        }

        abort(403, 'Unauthorized action');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            // Get the authenticated user's ID
            $userId = $request->input('user_id');

            // Get the user list based on the presence of the user_id parameter
            if ($userId) {
                $user = User::where('id', $userId)->get();
            } else {
                $user = User::all();
            }

            //$provinsi = ReffProvinsi::all();
            $kota = ReffKota::all();
            $cabor = ReffCabor::all();

            return view('staf.biodata.create', [
                'user' => $user,
                'user_id' => $userId,
                'kota' => $kota,
                'cabor' => $cabor,
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
         $request->validate([
            'user_id' => 'required',
            //'provinsi_id' => 'required',
            'kota_id' => 'required',
            'cabor_id' => 'required',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string',
            'nip_asn' => 'nullable|numeric',
            'npwp' => 'required|numeric',
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
            'status_anggota' => 'nullable|integer',
            'request_role' => 'nullable|integer',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $username = auth()->user()->name;

        // Using move priority, storeAs recommended for continue development
        // Process and store the first file if uploaded
        if ($request->hasFile('foto_diri')) {
            $file1 = $request->file('foto_diri');
            $nama_file1 = $username . '_' . $file1->getClientOriginalName();
            $tujuan_upload = 'biodata/foto_diri';
            $file1->move($tujuan_upload, $nama_file1);
        } else {
            $nama_file1 = null; // or whatever default value you want to set
        }

        // Process and store the second file if uploaded
        if ($request->hasFile('foto_ktp')) {
            $file2 = $request->file('foto_ktp');
            $nama_file2 = $username . '_' . $file2->getClientOriginalName();
            $tujuan_upload2 = 'biodata/foto_ktp';
            $file2->move($tujuan_upload2, $nama_file2);
        } else {
            $nama_file2 = null; // or whatever default value you want to set
        }

        // Process and store the third file if uploaded
        if ($request->hasFile('foto_npwp')) {
            $file3 = $request->file('foto_npwp');
            $nama_file3 = $username . '_' . $file3->getClientOriginalName();
            $tujuan_upload3 = 'biodata/foto_npwp';
            $file3->move($tujuan_upload3, $nama_file3);
        } else {
            $nama_file3 = null; // or whatever default value you want to set
        }

        $existing = Biodata::where('user_id', $request->user_id)->exists();

        // If there is an existing record, return with an error message
        if ($existing) {
            return redirect()->back()->withErrors(['user_id' => 'User sudah memiliki biodata.']);
        }

        // Create Biodata instance with the validated data and file paths
        Biodata::create([
            'user_id' => $request->user_id,
            //'provinsi_id' => $request->provinsi_id,
            'kota_id' => $request->kota_id,
            'cabor_id' => $request->cabor_id,
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

        $flashMessage = 'Biodata dibuat,';
        $flashMessage .= "\nNomor User: " . $request->input('user_id');
        $flashMessage .= "\nNama Lengkap: " . $user->nama_lengkap; // Add the user's nama_lengkap

        $request->session()->flash('success', $flashMessage);

        return redirect()->route('staf.registrasi.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (Gate::allows('is-staf')) {
            $biodata = Biodata::findOrFail($id);
            $kota = ReffKota::all();
            $cabor = ReffCabor::all();

            return view('staf.biodata.edit', [
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
     * @param  int  $id
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
        return redirect()->route('staf.biodata.index');
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
}
