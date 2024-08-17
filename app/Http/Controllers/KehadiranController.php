<?php

namespace App\Http\Controllers;
use App\Models\AnggotaAcaraRegistrasi;
use App\Models\AnggotaKehadiranRegistrasi;
use App\Models\Acara;
use App\Models\ReffCabor;
use App\Models\SesiAcara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-staf')) {
            $caborOptions = ReffCabor::all();
            $selectedYear = $request->input('year'); // Retrieve the selected year from the request
            $selectedAcara = $request->input('acara_id'); // Retrieve the selected acara_id
            $selectedSesi = $request->input('sesi');
            $selectedCabor = $request->input('cabor');
            $perPage = $request->input('per_page', 50);

            // Filter Acara by year if a year is selected, and ensure tipe = 1
            $acaraQuery = Acara::where('tipe', 1);
            if ($selectedYear) {
                $acaraQuery->where(function($query) use ($selectedYear) {
                    $query->whereYear('tanggal_awal_acara', $selectedYear)
                        ->orWhereYear('tanggal_akhir_acara', $selectedYear);
                });
            }
            $acara = $acaraQuery->get();

            // Filter SesiAcara based on the filtered acara and ensure tipe = 1
            $sesiOptions = SesiAcara::whereHas('acara', function ($query) use ($selectedYear, $selectedAcara) {
                $query->where('tipe', 1);
                if ($selectedYear) {
                    $query->where(function($subQuery) use ($selectedYear) {
                        $subQuery->whereYear('tanggal_awal_acara', $selectedYear)
                                ->orWhereYear('tanggal_akhir_acara', $selectedYear);
                    });
                }
                // Filter by selectedAcara if provided
                if ($selectedAcara) {
                    $query->where('id', $selectedAcara);
                }
            })->get();

            $query = AnggotaKehadiranRegistrasi::query();

            // Order by the newest date (created_at) first
            $query->orderBy('created_at', 'asc');

            // Filter by session if selected
            if ($selectedSesi) {
                $query->where('sesi_acara_id', $selectedSesi);
            } else {
                // Get the first session of the active event (where status_acara is 1 and tipe = 1)
                $activeEvent = Acara::where('status_acara', 1)->where('tipe', 1)->first();
                if ($activeEvent) {
                    $firstSession = $activeEvent->sesiAcara()->orderBy('created_at', 'asc')->first();
                    if ($firstSession) {
                        $query->where('sesi_acara_id', $firstSession->id);
                    }
                }
            }

            // Filter by nama_cabor if selected
            if ($selectedCabor) {
                $query->whereHas('user.biodata', function ($q) use ($selectedCabor) {
                    $q->where('nama_lengkap', 'like', '%' . $selectedCabor . '%')
                        ->orWhereHas('cabor', function ($q) use ($selectedCabor) {
                            $q->where('nama_cabor', 'like', '%' . $selectedCabor . '%');
                        });
                });
            }

            // Determine the default year (you can set this based on your rules)
            $defaultYear = $request->input('year', date('Y'));

            // Fetch the first active acara, regardless of the year, for default view
            $headerAcara = Acara::where('status_acara', 1)
                                ->where('tipe', 1)
                                ->orderBy('tanggal_awal_acara', 'desc') // Get the latest active event
                                ->first();

            // Determine the default year (you can set this based on your rules)
            $defaultYear = $request->input('year', date('Y'));

            // Fetch the first active acara, regardless of the year, for default view
            $headerAcara = Acara::where('status_acara', 1)
                                ->where('tipe', 1)
                                ->orderBy('tanggal_awal_acara', 'desc') // Get the latest active event
                                ->first();

            // If an active acara is found, update the defaultYear to match the event's year
            if ($headerAcara) {
                $defaultYear = date('Y', strtotime($headerAcara->tanggal_awal_acara));
            }

            // If no active acara found, fallback to the default year logic
            if (!$headerAcara) {
                $headerAcara = Acara::whereYear('tanggal_awal_acara', $defaultYear)
                                    ->where('status_acara', 1)
                                    ->where('tipe', 1)
                                    ->first();
            }

            // Fetch default sesi based on the acara
            $headerSesi = $headerAcara ? SesiAcara::where('acara_id', $headerAcara->id)->first() : null;

            if ($selectedAcara) {
                $headerAcara = Acara::find($selectedAcara);
                // Update defaultYear based on the selected Acara
                $defaultYear = date('Y', strtotime($headerAcara->tanggal_awal_acara));
            }

            if ($selectedSesi) {
                $headerSesi = SesiAcara::find($selectedSesi);
            }

            $kehadiran = $query->paginate($perPage);

            $sesiAcara = SesiAcara::all();

            return view('kehadiran.index', [
                'kehadiran' => $kehadiran,
                'sesiOptions' => $sesiOptions,
                'selectedSesi' => $selectedSesi,
                'selectedCabor' => $selectedCabor,
                'caborOptions' => $caborOptions,
                'acara' => $acara,
                'sesiAcara' => $sesiAcara,
                'selectedYear' => $selectedYear, // Pass the selected year to the view
                'selectedAcara' => $selectedAcara, // Pass the selected acara to the view
                'perPage' => $perPage,
                'defaultYear' => $defaultYear, // Pass the updated defaultYear to the view
                'headerAcara' => $headerAcara,
                'headerSesi' => $headerSesi,
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
        if (Gate::allows('is-admin')) {
            // Retrieve all users to populate dropdown/select
            $users = User::all();

            // Retrieve all sessions to populate dropdown/select
            $sesiAcara = SesiAcara::all();
            $acara = Acara::where('status_acara', 1)->where('tipe', 1)->get(); // Retrieve only active Acara records

            // Pass the users and sessions data to the view
            return view('kehadiran.create', compact('users', 'sesiAcara', 'acara'));
        }
    }

    public function absen(Request $request)
    {
        // Retrieve user_id and acara_id from the request
        $user_id = $request->query('user_id');
        $acara_id = $request->query('acara_id');

        // Retrieve all users to populate dropdown/select
        $users = User::all();

        // Retrieve all sessions to populate dropdown/select
        $sesiAcara = SesiAcara::all();

        // Retrieve the specific event based on the provided acara_id
        $acara = Acara::findOrFail($acara_id);

        // Retrieve the specific user based on the provided user_id
        $user = User::findOrFail($user_id);

        return view('absen.index', compact('users', 'sesiAcara', 'acara', 'user_id', 'user'));
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

        // Fetch the event ID associated with the session
        $sesiAcara = SesiAcara::find($request->sesi_acara_id);

        if (!$sesiAcara) {
            return redirect()->back()->withErrors(['sesi_acara_id' => 'Sesi acara tidak ditemukan.']);
        }

        // Check if the user is registered for the event
        $isRegistered = AnggotaAcaraRegistrasi::where('user_id', $request->user_id)
            ->where('acara_id', $sesiAcara->acara_id)
            ->exists();

        // If the user is not registered for the event, return with an error message
        if (!$isRegistered) {
            return redirect()->back()->withErrors(['user_id' => 'Anda tidak terdaftar pada acara ini.']);
        }

        // Create a new attendance record
        AnggotaKehadiranRegistrasi::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Absensi Berhasil');
    }

    public function storeAbsen(Request $request)
    {
        // Retrieve the necessary parameters from the request (user_id and sesi_acara_id)
        $user_id = $request->input('user_id');
        $sesi_acara_id = $request->input('sesi_acara_id');

        // Check if there is already an attendance record for the selected user and session
        $existingAttendance = AnggotaKehadiranRegistrasi::where('user_id', $user_id)
            ->where('sesi_acara_id', $sesi_acara_id)
            ->exists();

        // If there is an existing attendance record, redirect back with an error message
        if ($existingAttendance) {
            return Redirect::back()->withErrors(['user_id' => 'Sudah melakukan absensi untuk sesi ini.']);
        }

        // Create a new attendance record
        AnggotaKehadiranRegistrasi::create([
            'user_id' => $user_id,
            'sesi_acara_id' => $sesi_acara_id,
        ]);

        // Redirect back with success message
        return Redirect::back()->with('success', 'Absensi Berhasil');
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
    public function edit($id)
    {
        if (Gate::allows('is-admin')) {

            $kehadiran = AnggotaKehadiranRegistrasi::findOrFail($id);

            // Convert the created_at timestamp to the desired timezone
            $localizedDateTime = Carbon::parse($kehadiran->created_at)->timezone('Asia/Makassar');

            return view('kehadiran.edit', compact('kehadiran', 'localizedDateTime'));
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
        $kehadiran = AnggotaKehadiranRegistrasi::findOrFail($id);

        // Validate your request data here if needed

        // Convert input datetime string to Carbon instance
        $newCreatedAt = Carbon::parse($request->input('created_at'));

        // Update the created_at field with the new datetime
        $kehadiran->created_at = $newCreatedAt;

        // Save the changes
        $kehadiran->save();

        // Redirect or respond as needed
        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran updated successfully');
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
        return $pdf->stream('Kehadiran_pelatihan.pdf');
    }

}
