<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KodeAcara;
use App\Models\Acara;
use Illuminate\Support\Facades\Gate;

class KodeAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('is-admin')) {
            // Retrieve the selected event ID from the request
            $selectedAcara = $request->input('selected_acara');

            // Query all event codes
            $query = KodeAcara::query();

            // Apply filter if an event is selected
            if ($selectedAcara) {
                $query->where('acara_id', $selectedAcara);
            }

            // Retrieve paginated event codes
            $kode = $query->paginate(10);

            // Retrieve all events to populate the dropdown list
            $acaraOptions = Acara::paginate(10);

            // Pass the selected event ID and event options to the view
            return view('kode-acara.index', compact('kode', 'selectedAcara', 'acaraOptions'));
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
        $acara = Acara::all();
        return view('kode-acara.create', compact('acara'));
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
            'acara_id' => 'required|exists:acara,id',
            'code' => [
                'required',
                'unique:kode_acara,code',
                'regex:/^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{10,}$/'
            ]
        ], [
            'code.regex' => 'Kode dibuat setidaknya satu angka, satu huruf besar, satu simbol, dan minimal 10 karakter.'
        ]);

        // Create a new event code
        KodeAcara::create($request->all());

        return redirect()->route('kode-acara.index')->with('success', 'Kode acara berhasil dibuat');
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
}
