@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Data Kehadiran Peserta
        </div>
        <div class="card-body">

            @can('is-admin')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success">Excel</button>
                            <a class="btn btn-primary" href="{{ route('kehadiran.create') }}">Buat</a>
                            <a class="btn btn-secondary" href="{{ route('kehadiran.index') }}">Reset</a>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('kehadiran.index') }}" class="d-flex">
                            <select name="sesi" id="sesi" class="form-control form-control-sm">
                                <option selected>Filter per sesi</option>
                                <option value="">Semua Sesi</option>
                                @foreach ($sesiOptions as $sesi)
                                    <option value="{{ $sesi->id }}" {{ $sesi->id == $selectedSesi ? 'selected' : '' }}>
                                        {{ $sesi->sesi }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="col-md-6 ms-3">
                                <button type="submit" class="btn btn-sm btn-primary me-2">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('absen.export-pdf') }}" target="_blank" class="d-flex">
                            <select name="sesi" id="sesi" class="form-control form-control-sm">
                                <option value="">Semua Sesi</option>
                                @foreach ($sesiOptions as $sesi)
                                    <option value="{{ $sesi->id }}" {{ $sesi->id == $selectedSesi ? 'selected' : '' }}>
                                        {{ $sesi->sesi }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="col-md-6 ms-3">
                                <button type="submit" class="btn btn-sm btn-danger me-2">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </div>
                        </form>
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
                                <th scope="col">NIK</th>
                                <th scope="col">Waktu Absen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kehadiran as $index => $k)
                                <tr>
                                    <td>{{ $index + $kehadiran->firstItem() }}</td>
                                    <td>{{ $k->user->nama_lengkap }}</td>
                                    <td>{{ $k->user->nomor_ktp }}</td>
                                    <td>{{ $k->sesiAcara->sesi }}</td>
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
            {{ $kehadiran->links() }}

        </div>
    </div>

    <script>
        // Get reference to the session select element
         const sessionSelect = document.getElementById('sesi');

         // Event listener for when the session selection changes
         sessionSelect.addEventListener('change', (event) => {
             // Submit the form when a session is selected
             event.target.form.submit();
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
