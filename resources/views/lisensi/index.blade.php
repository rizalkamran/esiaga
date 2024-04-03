@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Sertifikat/Lisensi
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" href="{{ route('lisensi.create') }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('lisensi.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('lisensi.index') }}" method="get" style="display: inline-flex; align-items: center;">
                            <div class="form-group mr-2" style="margin-bottom: 0;">
                                <input type="text" class="form-control form-control-sm" name="search" placeholder="Cari ...">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary ms-2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if (!$lisensi->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Cabor/Afiliasi</th>
                            <th>Jenis Kelamin</th>
                            <th>Tingkat</th>
                            <th>Nama Lisensi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lisensi as $index => $lis)
                            <tr>
                                <td>{{ $index + $lisensi->firstItem() }}</td>
                                <td>{{ $lis->user->nama_lengkap }}</td>
                                <td>{{ $lis->cabor->nama_cabor }}</td>
                                <td>
                                    @if ($lis->user->jenis_kelamin == 'L')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td>{{ $lis->tingkat }}</td>
                                <td>{{ $lis->nama_lisensi }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $lis->id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Peringatan</h4>
                    <p>Harap isi data lisensi terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $lisensi->appends(['search' => $searchQuery])->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($lisensi as $lis)
        <div class="modal fade" id="imagesModal{{ $lis->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $lis->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $lis->id }}">Detail Sertifikat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Tingkat:</p>
                                    <p>{{ $lis->tingkat }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Profesi:</p>
                                    <p>{{ $lis->profesi }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Tanggal Berakhir:</p>
                                    <p>{{ \Carbon\Carbon::parse($lis->tgl_mulai)->format('d-m-Y') }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Tanggal Berakhir:</p>
                                    <p>{{ \Carbon\Carbon::parse($lis->tgl_selesai)->format('d-m-Y') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Penyelenggara:</p>
                                    <p>{{ $lis->penyelenggara }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Foto Sertifikat:</p>
                                    <img src="{{ asset('foto_lisensi/' . $lis->foto_lisensi) }}" alt="Foto Lisensi" class="img-fluid mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('templates.footer')
@endsection
