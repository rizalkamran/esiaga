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
                            <a class="btn btn-primary" href="{{ route('registrasi.index') }}">Reset</a>
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
                                    <select class="form-control form-control-sm" id="acara" name="acara">
                                        <option value="">All/Semua</option>
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
                            <th scope="col">NIK</th>
                            <th scope="col">Waktu Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $index => $ag)
                            <tr>
                                <td>{{ $index + $anggota->firstItem() }}</td>
                                <td>{{ $ag->user->nama_lengkap }}</td>
                                <td>{{ $ag->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                                <td>{{ $ag->user->nomor_ktp }}</td>
                                <td>{{ $ag->created_at->format('d-m-Y H:i:s') }}</td>
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

            {{ $anggota->links() }} <!-- Pagination Links -->

        </div>
    </div>

    @include('templates.footer')
@endsection


