@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Prestasi
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        {{-- <a class="btn btn-primary" href="{{ route('prestasi.create') }}">Buat</a> --}}
                        <a class="btn btn-primary" href="{{ route('prestasi.create', ['user_id' => request()->query('user_id')]) }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('prestasi.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('prestasi.index') }}" method="get" style="display: inline-flex; align-items: center;">
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

            @if (!$prestasi->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>Tipe - Cabor</th>
                            <th>Prestasi</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestasi as $index => $pre)
                            <tr>
                                <td>{{ $index + $prestasi->firstItem() }}</td>
                                <td>{{ $pre->user->nama_lengkap }}</td>
                                <td>
                                    @if ($pre->user->jenis_kelamin == 'L')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $pre->tipe_prestasi }} - {{ $pre->cabor->nama_cabor }}</td>
                                <td>{{ $pre->prestasi }}</td>
                                <td>{{ $pre->tahun }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $pre->id }}">
                                        Detail
                                    </button>
                                    <a href="{{ route('prestasi.edit', $pre->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pre->id }}">
                                        Delete
                                    </button>
                                    <form id="delete-user-form-{{ $pre->id }}" action="{{ route('prestasi.destroy',  $pre->id) }}" method="POST" style="display: none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{  $pre->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{  $pre->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{  $pre->id }}">Hapus data prestasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus data ini?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{  $pre->id }}').submit()">Hapus</button>
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
                    <p>Harap isi prestasi terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $prestasi->appends(['search' => $searchQuery])->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($prestasi as $pre)
        <div class="modal fade" id="imagesModal{{ $pre->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $pre->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $pre->id }}">Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 text-center">
                            <div class="col">
                                <p class="fw-bold">Nama Event:</p>
                                <p>{{ $pre->nama_event }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Nama Team:</p>
                                <p>{{ $pre->nama_team }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Rekor:</p>
                                <p>{{ $pre->rekor }}</p>
                            </div>
                        </div>
                        <div class="row mb-3 text-center">
                            <div class="col">
                                <p class="fw-bold">Catatan:</p>
                                <p>{{ $pre->catatan }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Nomor Bukti Prestasi:</p>
                                <p>{{ $pre->nomor_bukti_prestasi }}</p>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <img src="{{ asset('file_bukti_prestasi/' . $pre->file_bukti_prestasi) }}" alt="Foto Prestasi" class="img-fluid mb-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('templates.footer')
@endsection
