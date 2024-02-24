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
                            <a class="btn btn-primary" href="{{ route('kehadiran.index') }}">Reset</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end">
                            <form action="{{ route('absen.export-pdf') }}" method="get" target="_blank" style="display: inline-flex; align-items: center;">
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <select class="form-control form-control-sm" id="acara" name="acara">
                                        <option value="">All/Semua</option>
                                        @foreach($acaraOptions as $acara)
                                            <option value="{{ $acara->id }}" {{ $selectedAcara == $acara->id ? 'selected' : '' }}>{{ Illuminate\Support\Str::limit($acara->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <input type="date" class="form-control form-control-sm" id="date" name="date" value="{{ $selectedDate }}" />
                                </div>
                                <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 5px;">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="float-end">
                            <form action="{{ route('kehadiran.index') }}" method="GET" style="display: inline-flex; align-items: center;">
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <select class="form-control form-control-sm" id="acara" name="acara">
                                        <option value="">All/Semua</option>
                                        @foreach($acaraOptions as $acara)
                                            <option value="{{ $acara->id }}" {{ $selectedAcara == $acara->id ? 'selected' : '' }}>{{ Illuminate\Support\Str::limit($acara->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <input type="date" class="form-control form-control-sm" id="date" name="date" value="{{ $selectedDate }}" />
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 5px;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @if (!$kehadiran->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Acara</th>
                            <th scope="col">Waktu Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadiran as $index => $k)
                            <tr>
                                <td>{{ $index + $kehadiran->firstItem() }}</td>
                                <td>{{ $k->user->nama_lengkap }}</td>
                                <td>{{ $k->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                                <td>{{ $k->user->nomor_ktp }}</td>
                                <td>{{ Illuminate\Support\Str::limit($k->acara->nama_acara, 30) }}</td>
                                <td>{{ $k->created_at->format('d-m-Y H:i:s') }}</td>
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

            {{ $kehadiran->links() }} <!-- Pagination Links -->

        </div>
    </div>

    @include('templates.footer')
@endsection
