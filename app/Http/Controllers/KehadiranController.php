<?php

namespace App\Http\Controllers;
use App\Models\AnggotaKehadiranRegistrasi;
use App\Models\Acara;
use App\Models\ReffCabor;
use App\Models\SesiAcara;
use App\Models\User;
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
        $caborOptions = ReffCabor::all();
        // Retrieve all session options for the dropdown
        $sesiOptions = SesiAcara::all();

        // Retrieve the selected session from the request
        $selectedSesi = $request->input('sesi');
        $selectedCabor = $request->input('cabor');

        // Check if the user is an admin
        if (Gate::allows('is-admin')) {
            // Filter by session if selected
            $query = AnggotaKehadiranRegistrasi::query();
            if ($selectedSesi) {
                $query->where('sesi_acara_id', $selectedSesi);
            }

            // Filter by nama_cabor if selected
            if ($selectedCabor) {
                $query->whereHas('user.biodata.cabor', function ($q) use ($selectedCabor) {
                    $q->where('nama_cabor', 'like', '%' . $selectedCabor . '%');
                });
            }

            // Paginate the results
            $kehadiran = $query->paginate(10);

            // Pass the attendance data and other necessary data to the view
            return view('kehadiran.index', compact('kehadiran', 'sesiOptions', 'selectedSesi', 'selectedCabor', 'caborOptions'));
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
        if (Gate::allows('is-admin')) {
            // Retrieve all users to populate dropdown/select
            $users = User::all();

            // Retrieve all sessions to populate dropdown/select
            $sesiAcara = SesiAcara::all();
            $acara = Acara::all();

            // Pass the users and sessions data to the view
            return view('kehadiran.create', compact('users', 'sesiAcara', 'acara'));
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required',
            'sesi_acara_id' => 'required',
        ]);

        // Check if there is already an attendance record for the selected user and session
        $existingAttendance = AnggotaKehadiranRegistrasi::where('user_id', $request->user_id)
            ->where('sesi_acara_id', $request->sesi_acara_id)
            ->exists();

        // If there is an existing attendance record, return with an error message
        if ($existingAttendance) {
            return redirect()->back()->withErrors(['user_id' => 'Sudah melakukan absensi untuk sesi ini.']);
        }

        // Create a new attendance record
        AnggotaKehadiranRegistrasi::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Absensi Berhasil');
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
        // Retrieve the selected session from the request
        $selectedSesi = $request->input('sesi');

        // Filter by session if selected
        $query = AnggotaKehadiranRegistrasi::query()->with('sesiAcara'); // Eager load the 'sesiAcara' relationship
        if ($selectedSesi) {
            $query->where('sesi_acara_id', $selectedSesi);
        }

        // Get the filtered data
        $kehadiran = $query->get();

        // Generate PDF
        $pdf = PDF::loadView('kehadiran.export-pdf', compact('kehadiran'));

        // Set paper orientation to landscape
        $pdf->setPaper('a4', 'landscape');

        // You can customize the filename if needed
        return $pdf->stream('kehadiran.pdf');
    }

}
