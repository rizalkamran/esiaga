@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Pekerjaan
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        {{-- <a class="btn btn-primary" href="{{ route('pekerjaan.create') }}">Buat</a> --}}
                        <a class="btn btn-primary" href="{{ route('pekerjaan.create', ['user_id' => request()->query('user_id')]) }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('pekerjaan.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('pekerjaan.index') }}" method="get" style="display: inline-flex; align-items: center;">
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

            @if (!$pekerjaan->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>Pekerjaan</th>
                            <th>Tipe Kerja</th>
                            <th>Tanggal mulai/Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pekerjaan as $index => $pe)
                            <tr>
                                <td>{{ $index + $pekerjaan->firstItem() }}</td>
                                <td>{{ $pe->user->nama_lengkap }}</td>
                                <td>
                                    @if ($pe->user->jenis_kelamin == 'L')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $pe->pekerjaan }}</td>
                                <td>{{ $pe->tipe_kerja }}</td>
                                <td>
                                    @if ($pe->status_kerja == 1)
                                        {{ \Carbon\Carbon::parse($pe->tgl_mulai)->format('d-m-Y') }} / Sekarang
                                    @else
                                        {{ \Carbon\Carbon::parse($pe->tgl_mulai)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($pe->tgl_selesai)->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $pe->id }}">
                                        Detail
                                    </button>
                                    <a href="{{ route('pekerjaan.edit', $pe->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pe->id }}">
                                        Delete
                                    </button>
                                    <form id="delete-user-form-{{ $pe->id }}" action="{{ route('pekerjaan.destroy',  $pe->id) }}" method="POST" style="display: none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{  $pe->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{  $pe->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{  $pe->id }}">Hapus data pekerjaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus data ini?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{  $pe->id }}').submit()">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Peringatan</h4>
                    <p>Harap isi pekerjaan terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $pekerjaan->appends(['search' => $searchQuery])->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($pekerjaan as $pe)
        <div class="modal fade" id="imagesModal{{ $pe->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $pe->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $pe->id }}">Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-md-7">
                                <dl class="row">
                                    <dt class="col-sm-3">Nama Instansi</dt>
                                    <dd class="col-sm-9">{{ $pe->nama_instansi }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">Alamat Instansi</dt>
                                    <dd class="col-sm-9">{{ $pe->alamat_instansi }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">Kontak Instansi</dt>
                                    <dd class="col-sm-9">{{ $pe->kontak_instansi }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-5">
                                <h6>Bukti Pekerjaan</h6>
                                <img src="{{ asset('bukti_kerja/' . $pe->bukti_kerja) }}" alt="Bukti Kerja" class="img-fluid mb-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('templates.footer')
@endsection
