@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Peran Anggota
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" href="{{ route('anggota_peran.create', ['user_id' => request()->query('user_id')]) }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('anggota_peran.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('anggota_peran.index') }}" method="get" style="display: inline-flex; align-items: center;">
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

            @if (!$anggota_peran->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>Cabor</th>
                            <th>Jabatan</th>
                            <th>Peran / Status</th>
                            <th>Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota_peran as $index => $anggota)
                            <tr>
                                <td>{{ $index + $anggota_peran->firstItem() }}</td>
                                <td>{{ $anggota->user->nama_lengkap }}</td>
                                <td>
                                    @if ($anggota->user->jenis_kelamin == 'L')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $anggota->cabor->nama_cabor }}</td>
                                <td>{{ $anggota->jabatan }}</td>
                                <td>
                                    @if ($anggota->status_aktif_peran)
                                        <span class="badge bg-success">{{ $anggota->peran->nama_peran}} / Aktif</span>
                                    @else
                                        <span class="badge bg-danger">{{ $anggota->peran->nama_peran}} / Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($anggota->status_verifikasi_peran)
                                        <span class="badge bg-success">Sudah</span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $anggota->id }}">
                                        Detail
                                    </button>
                                    <a href="{{ route('anggota_peran.edit', $anggota->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $anggota->id }}">
                                        Delete
                                    </button>
                                    <form id="delete-user-form-{{ $anggota->id }}" action="{{ route('anggota_peran.destroy',  $anggota->id) }}" method="POST" style="display: none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{  $anggota->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{  $anggota->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{  $anggota->id }}">Hapus data anggota_peran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus data ini?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{  $anggota->id }}').submit()">Hapus</button>
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
                    <p>Harap isi data terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $anggota_peran->appends(['search' => $searchQuery])->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($anggota_peran as $anggota)
        <div class="modal fade" id="imagesModal{{ $anggota->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $anggota->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $anggota->id }}">Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Tempat Lahir:</p>
                                    <p>{{ $anggota->nama_lembaga }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Tanggal Lahir:</p>
                                    <p>{{ $anggota->provinsi_lembaga }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Tempat Lahir:</p>
                                    <p>{{ $anggota->kota_lembaga }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Tanggal Lahir:</p>
                                    <p>{{ $anggota->kecamatan_lembaga }}</p>
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
