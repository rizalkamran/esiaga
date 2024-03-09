@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Data Kehadiran Peserta
        </div>
        <div class="card-body">

            @can('is-admin')
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success">Excel</button>
                            <a class="btn btn-primary" href="{{ route('kehadiran.create') }}">Buat</a>
                            <a class="btn btn-secondary" href="{{ route('kehadiran.index') }}">Reset</a>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="float-end">
                            <form action="{{ route('absen.export-pdf') }}" method="get" target="_blank"
                                style="display: inline-flex; align-items: center;">
                                <select name="acara_id" class="form-control form-control-sm" id="acara_id_export">
                                    <option selected disabled>Pilih Acara</option>
                                    @foreach ($acara as $ac)
                                        <option value="{{ $ac->id }}">
                                            {{ Illuminate\Support\Str::limit($ac->nama_acara, 30) }}</option>
                                    @endforeach
                                </select>
                                <select name="sesi" id="sesi_export" class="form-control form-control-sm">
                                    <option selected disabled>Filter per sesi</option>
                                    <option value="">Semua Sesi</option>
                                    <!-- Populate session options -->
                                    @foreach ($sesiOptions as $sesi)
                                        <option value="{{ $sesi->id }}" {{ $sesi->id == $selectedSesi ? 'selected' : '' }}>
                                            {{ $sesi->sesi }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-danger ms-2">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('kehadiran.index') }}" class="d-flex">
                            <div class="form-group">
                                <input type="text" name="cabor" id="cabor" class="form-control form-control-sm" placeholder="Cari ..." value="{{ $selectedCabor ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary ms-2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="float-end">
                            <form method="GET" action="{{ route('kehadiran.index') }}" class="d-flex">
                                <select name="acara_id" class="form-control form-control-sm" id="acara_id_filter">
                                    <option selected disabled>Pilih Acara</option>
                                    @foreach ($acara as $ac)
                                        <option value="{{ $ac->id }}">
                                            {{ Illuminate\Support\Str::limit($ac->nama_acara, 30) }}</option>
                                    @endforeach
                                </select>
                                <select name="sesi" id="sesi_filter" class="form-control form-control-sm">
                                    <option selected disabled>Filter per sesi</option>
                                    <option value="">Semua Sesi</option>
                                    @foreach ($sesiOptions as $sesi)
                                        <option value="{{ $sesi->id }}"
                                            {{ $sesi->id == $selectedSesi ? 'selected' : '' }}>
                                            {{ $sesi->sesi }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary ms-2">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            <!-- Table to display absence data -->
            @if (!$kehadiran->isEmpty())
                <div class="table-responsive-md">
                    <table id="absence-table" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Cabor / Afiliasi</th>
                                <th scope="col">Acara/Sesi</th>
                                <th scope="col">Waktu Hadir</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kehadiran as $index => $k)
                                <tr>
                                    <td>{{ $index + $kehadiran->firstItem() }}</td>
                                    <td>{{ $k->user->nama_lengkap }}</td>
                                    <td>{{ $k->user->biodata->cabor->nama_cabor }}</td>
                                    <td>{{  Illuminate\Support\Str::limit($k->sesiAcara->acara->nama_acara, 30) }} - {{ $k->sesiAcara->sesi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($k->created_at)->locale('id_ID')->format('H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('kehadiran.edit', ['kehadiran' => $k->id]) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Peringatan</h4>
                    <p>Tidak ada data kehadiran peserta</p>
                </div>
            @endif

            <!-- Pagination Links -->
            {{ $kehadiran->appends(['sesi' => $selectedSesi, 'cabor' => $selectedCabor])->links() }}

        </div>
    </div>

    <script>
        // Get references to the event and session select elements in the second form
        const eventSelectFilter = document.getElementById('acara_id_filter');
        const sessionSelectFilter = document.getElementById('sesi_filter');

        // Add change event listener to the event select in the second form
        eventSelectFilter.addEventListener('change', (event) => {
            const selectedEventId = event.target.value;

            // Reset session options
            sessionSelectFilter.innerHTML = '<option selected>Filter per sesi</option>';

            // Populate session options associated with the selected event
            @foreach ($sesiAcara as $session)
                if ({{ $session->acara_id }} == selectedEventId) {
                    const option = document.createElement('option');
                    option.value = {{ $session->id }};
                    option.textContent = "{{ $session->sesi }}";
                    sessionSelectFilter.appendChild(option);
                }
            @endforeach
        });
    </script>

    <script>
        // Get references to the event and session select elements in the export form
        const eventSelectExport = document.getElementById('acara_id_export');
        const sessionSelectExport = document.getElementById('sesi_export');

        // Add change event listener to the event select in the export form
        eventSelectExport.addEventListener('change', (event) => {
            const selectedEventId = event.target.value;

            // Reset session options
            sessionSelectExport.innerHTML = '<option selected disabled>Filter per sesi</option>';

            // Populate session options associated with the selected event
            @foreach ($sesiAcara as $session)
                if ({{ $session->acara_id }} == selectedEventId) {
                    const option = document.createElement('option');
                    option.value = {{ $session->id }};
                    option.textContent = "{{ $session->sesi }}";
                    sessionSelectExport.appendChild(option);
                }
            @endforeach
        });
    </script>


    {{-- <script>
        // Initialize Laravel Echo
        const echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true,
        });

        // Listen for events
        echo.channel('absence-channel')
            .listen('.AbsenceSubmitted', (event) => {
                // Update UI with updatedData from the event
                // For example, you can append new absence data to the absence table
                console.log(event.updatedData); // You can use this data to update your UI

                // Assuming 'event.updatedData' contains the new absence data
                // You can append a new row to the absence table
                const newAbsenceData = event.updatedData;
                const tableBody = document.querySelector('#absence-table tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${newAbsenceData.name}</td>
                    <td>${newAbsenceData.date}</td>
                    <!-- Add more cells as needed -->
                `;
                tableBody.appendChild(newRow);
            });
    </script> --}}

    @include('templates.footer')
@endsection
