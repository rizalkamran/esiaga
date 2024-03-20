@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Data Registrasi Peserta
        </div>
        <div class="card-body">

            @can('is-admin')
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success">Excel</button>
                            <a class="btn btn-secondary" href="{{ route('registrasi.index') }}">Reset</a>
                            <a class="btn btn-primary" href="{{ route('registrasi.create') }}">Create</a>
                            <button id="togglePagination" class="btn btn-sm btn-warning">Toggle All data</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="float-end">
                            <form action="{{ route('regis.export-pdf') }}" method="get" target="_blank" style="display: inline-flex; align-items: center;">
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <select class="form-control form-control-sm" id="acara" name="acara">
                                        <option value="">All/Semua</option>
                                        @foreach($acaraOptions as $acaraOption)
                                            <option value="{{ $acaraOption->id }}" {{ $selectedAcara == $acaraOption->id ? 'selected' : '' }}>{{ Illuminate\Support\Str::limit($acaraOption->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 5px;">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="float-end">
                            <form action="{{ route('registrasi.index') }}" method="GET" style="display: inline-flex; align-items: center;">
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Cari ...">
                                </div>
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <select class="form-control form-control-sm" id="acara" name="acara">
                                        <option value="">Semua Acara</option>
                                        @foreach($acaraOptions as $acaraOption)
                                            <option value="{{ $acaraOption->id }}" {{ $selectedAcara == $acaraOption->id ? 'selected' : '' }}>{{ Illuminate\Support\Str::limit($acaraOption->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 5px;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @if (!$anggota->isEmpty())

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Cabor / Afliliasi</th>
                            <th scope="col">Waktu Daftar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $ag)
                        <tr>
                            <td>{{ ($anggota->currentPage() - 1) * $anggota->perPage() + $loop->iteration }}</td>
                            <td>{{ $ag->user->nama_lengkap }}</td>
                            <td>{{ $ag->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                            <td>{{ $ag->user->biodata->cabor->nama_cabor }}</td>
                            <td>{{ $ag->created_at->locale('id_ID')->isoFormat('D MMMM YYYY H:mm:ss') }}</td>
                            <td>
                                <a href="{{ route('registrasi.edit', $ag) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Modal Button -->
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$ag->id}}">
                                    Details
                                </button>

                                <a href="{{ route('regis.export-user-pdf', $ag->id) }}" class="btn btn-sm btn-danger" target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$ag->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Registration Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display Registration Details Here -->
                                                <!-- You can customize this part to display the details you want -->
                                                <p><strong>Nama Lengkap:</strong> {{ $ag->user->nama_lengkap }}</p>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        @if ($ag->mandat)
                                                            @php
                                                                $mandatPath = 'mandat/' . $ag->mandat;
                                                                $mandatUrl = asset($mandatPath);
                                                            @endphp
                                                            @if (file_exists(public_path($mandatPath)) && is_readable(public_path($mandatPath)))
                                                                @if (Str::endsWith($ag->mandat, ['.jpg', '.jpeg', '.png', '.gif']))
                                                                    <!-- Display image -->
                                                                    <img src="{{ $mandatUrl }}" alt="Mandat" class="img-fluid mb-3">
                                                                @elseif (Str::endsWith($ag->mandat, '.pdf'))
                                                                    <!-- Display PDF -->
                                                                    <div class="embed-responsive embed-responsive-16by9">
                                                                        <iframe class="embed-responsive-item" src="{{ $mandatUrl }}"></iframe>
                                                                    </div>
                                                                @else
                                                                    <!-- Unsupported file type -->
                                                                    <p>Unsupported file type</p>
                                                                @endif
                                                            @else
                                                                <!-- File not found or not readable -->
                                                                <p>File not found or not readable</p>
                                                            @endif
                                                        @else
                                                            <!-- No file uploaded -->
                                                            <p>No file uploaded</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>QR Code</p>
                                                        <img src="{{ asset('qrcodes/registrasi/' . $ag->qrcode_registrasi) }}" alt="QR Code" style="height:auto;width:30%;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Peringatan</h4>
                <p>Tidak ada data registrasi peserta</p>
            </div>
            @endif

            <div id="paginationLinks"> <!-- Add this container around the pagination links -->
                @if ($anggota instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {!! $anggota->appends(['search' => $searchQuery, 'acara' => $selectedAcara])->links() !!}
                @endif
            </div>

            <div>
                <div class="row">
                    <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $anggota->total() }}</p>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <p class="btn btn-sm btn-secondary">Data/Page: {{ $anggota->count() }} / {{ $anggota->currentPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Event listener for toggle button click
        document.getElementById('togglePagination').addEventListener('click', function() {
            const url = new URL(window.location.href);
            const showAll = url.searchParams.get('showAll') ? 0 : 1; // Toggle showAll parameter
            url.searchParams.set('showAll', showAll); // Set the showAll parameter in the URL
            window.location.href = url.toString(); // Redirect to the new URL
        });
    </script>

    @include('templates.footer')
@endsection


