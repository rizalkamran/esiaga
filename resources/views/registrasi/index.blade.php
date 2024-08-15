@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Data Registrasi - Pelatihan
        </div>
        <div class="card-body">

            @can('is-admin')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a class="btn btn-primary" href="{{ route('registrasi.create') }}">Create</a>
                            <a class="btn btn-secondary me-2" href="{{ route('registrasi.index') }}">Reset</a>

                            <form action="{{ route('registrasi.index') }}" method="GET" style="display: inline-flex; align-items: center;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <select name="per_page" class="form-select form-select-sm" id="perPage" onchange="this.form.submit()">
                                        <option selected disabled>Per Page</option>
                                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                        <option value="75" {{ $perPage == 75 ? 'selected' : '' }}>75</option>
                                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                        <option value="150" {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                                        <option value="200" {{ $perPage == 200 ? 'selected' : '' }}>200</option>
                                        <option value="250" {{ $perPage == 250 ? 'selected' : '' }}>250</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <!-- Text for Print PDF -->
                            <span class="badge rounded-pill text-bg-info mr-3" style="min-width: 100px; text-align: center;">Print PDF</span>

                            <!-- Year Filter Form -->
                            <form action="{{ route('registrasi.index') }}" method="GET" class="d-flex align-items-center mx-2">
                                <input type="hidden" name="per_page" value="{{ $perPage }}">
                                <select class="form-control form-control-sm" id="year" name="year" onchange="this.form.submit()">
                                    <option value="" selected>Pilih Tahun</option>
                                    @foreach(range(date('Y'), 2022) as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            <!-- PDF Export Form -->
                            <form action="{{ route('regis.export-pdf') }}" method="get" target="_blank" class="d-flex align-items-center mx-2">
                                <select class="form-control form-control-sm mr-2" id="acara" name="acara">
                                    <option value="">Pilih Acara</option>
                                    @foreach($acaraOptions as $acaraOption)
                                        <option value="{{ $acaraOption->id }}" {{ $selectedAcara == $acaraOption->id ? 'selected' : '' }}>
                                            {{ Illuminate\Support\Str::limit($acaraOption->nama_acara, 35) }}
                                        </option>
                                    @endforeach
                                </select>
                                <select class="form-control form-control-sm mr-2" id="peran" name="peran">
                                    <option value="">Pilih Peran</option>
                                    @foreach($peranOptions as $peranOption)
                                        <option value="{{ $peranOption->id }}" {{ $selectedPeran == $peranOption->id ? 'selected' : '' }}>
                                            {{ $peranOption->nama_peran }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <!-- Text for Filter Data -->
                            <span class="badge rounded-pill text-bg-info mr-3" style="min-width: 100px; text-align: center;">Filter Data</span>

                            <!-- Year Filter Form -->
                            <form action="{{ route('registrasi.index') }}" method="GET" class="d-flex align-items-center mx-2">
                                <input type="hidden" name="per_page" value="{{ $perPage }}">
                                <select class="form-control form-control-sm" id="year" name="year" onchange="this.form.submit()">
                                    <option value="" selected>Pilih Tahun</option>
                                    @foreach(range(date('Y'), 2022) as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            <!-- Filter Data Form -->
                            <form action="{{ route('registrasi.index') }}" method="GET" class="d-flex align-items-center mx-2">
                                <input type="hidden" name="year" value="{{ request('year') }}"> <!-- Preserve selected year -->
                                <select class="form-control form-control-sm mr-2" id="acara" name="acara">
                                    <option value="">Pilih Acara</option>
                                    @foreach($acaraOptions as $acaraOption)
                                        <option value="{{ $acaraOption->id }}" {{ $selectedAcara == $acaraOption->id ? 'selected' : '' }}>
                                            {{ Illuminate\Support\Str::limit($acaraOption->nama_acara, 35) }}
                                        </option>
                                    @endforeach
                                </select>
                                <select class="form-control form-control-sm mr-2" id="peran" name="peran">
                                    <option value="">Pilih Peran</option>
                                    @foreach($peranOptions as $peranOption)
                                        <option value="{{ $peranOption->id }}" {{ $selectedPeran == $peranOption->id ? 'selected' : '' }}>
                                            {{ $peranOption->nama_peran }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="per_page" value="{{ $perPage }}">
                                <input type="text" class="form-control form-control-sm mr-2" name="search" placeholder="Cari ...">
                                <button type="submit" class="btn btn-sm btn-primary">
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
                            <th scope="col">L/P</th>
                            <th scope="col">Peran</th>
                            <th scope="col">Cabor / Afliliasi</th>
                            <th scope="col">Lampiran</th>
                            <th scope="col">Surat Mandat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $ag)
                        <tr>
                            <td>{{ ($anggota->currentPage() - 1) * $anggota->perPage() + $loop->iteration }}</td>
                            <td>{{ $ag->user->nama_lengkap }}</td>
                            <td>{{ $ag->user->jenis_kelamin}}</td>
                            <td>{{ $ag->peran?->nama_peran ?? 'Data belum diisi' }}</td>
                            <td>
                                {{ Illuminate\Support\Str::limit($ag->user->biodata?->cabor?->nama_cabor ?? 'Data belum diisi', 20) }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm {{ $ag->user->biodata && $ag->user->biodata->foto_diri ? 'btn-success' : 'btn-secondary disabled' }}" data-bs-toggle="modal" data-bs-target="#Modal1{{$ag->id}}">
                                    Foto
                                </button>
                                <button type="button" class="btn btn-sm {{ $ag->user->biodata && $ag->user->biodata->foto_ktp ? 'btn-success' : 'btn-secondary disabled' }}" data-bs-toggle="modal" data-bs-target="#Modal2{{$ag->id}}">
                                    KTP
                                </button>
                                <button type="button" class="btn btn-sm {{ $ag->user->biodata && $ag->user->biodata->foto_npwp ? 'btn-success' : 'btn-secondary disabled' }}" data-bs-toggle="modal" data-bs-target="#Modal3{{$ag->id}}">
                                    NPWP
                                </button>
                                <a href="{{ route('biodata_admin.index', ['user_id' => $ag->user->id]) }}" class="btn btn-sm btn-primary" target="_blank">
                                    Link
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('registrasi.edit', $ag) }}" class="btn btn-sm btn-primary">Upload</a>

                                <!-- Modal Button -->
                                <button type="button" class="btn btn-sm {{ $ag->mandat ? 'btn-success' : 'btn-secondary disabled' }}" data-bs-toggle="modal" data-bs-target="#exampleModal{{$ag->id}}">
                                    Lihat
                                </button>

                                <a href="{{ route('regis.export-user-pdf', $ag->id) }}" class="btn btn-sm btn-danger" target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>

                                <!-- Modal Lampiran -->
                                <div class="modal fade" id="Modal1{{$ag->id}}" tabindex="-1" aria-labelledby="Modal1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="Modal1">Foto Profil</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display Registration Details Here -->
                                                @if ($ag->user->biodata && $ag->user->biodata->foto_diri)
                                                    <img src="{{ asset('biodata/foto_diri/' . $ag->user->biodata->foto_diri) }}" alt="Foto Diri" style="width: 50%; height: auto;">
                                                @else
                                                    Foto tidak tersedia
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="Modal2{{$ag->id}}" tabindex="-1" aria-labelledby="Modal2" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="Modal2">KTP</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display Registration Details Here -->
                                                @if ($ag->user->biodata && $ag->user->biodata->foto_ktp)
                                                    <img src="{{ asset('biodata/foto_ktp/' . $ag->user->biodata->foto_ktp) }}" alt="Foto KTP" style="width: 50%; height: auto;">
                                                @else
                                                    Foto tidak tersedia
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="Modal3{{$ag->id}}" tabindex="-1" aria-labelledby="Modal3" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="Modal3">NPWP</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display Registration Details Here -->
                                                @if ($ag->user->biodata && $ag->user->biodata->foto_npwp)
                                                    <img src="{{ asset('biodata/foto_npwp/' . $ag->user->biodata->foto_npwp) }}" alt="Foto NPWP" style="width: 50%; height: auto;">
                                                @else
                                                    Foto tidak tersedia
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

            {{ $anggota->appends(['search' => $searchQuery, 'acara' => $selectedAcara, 'peran' => $selectedPeran, 'per_page' => $perPage])->links() }}

            <div>
                <div class="row">
                    <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $anggota->total() }}</p>
                        <p class="btn btn-sm btn-secondary">Foto: {{ $totalFoto }}</p>
                        <p class="btn btn-sm btn-secondary">KTP: {{ $totalKTP }}</p>
                        <p class="btn btn-sm btn-secondary">NPWP: {{ $totalNPWP }}</p>
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

    @include('templates.footer')
@endsection


