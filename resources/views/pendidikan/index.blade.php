@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Diklat
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        {{-- <a class="btn btn-primary" href="{{ route('pendidikan.create') }}">Buat</a> --}}
                        <a class="btn btn-primary" href="{{ route('pendidikan.create', ['user_id' => request()->query('user_id')]) }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('pendidikan.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('pendidikan.index') }}" method="get" style="display: inline-flex; align-items: center;">
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

            @if (!$pendidikan->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>Tingkat Pendidikan</th>
                            <th>Tahun Lulus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendidikan as $index => $pen)
                            <tr>
                                <td>{{ $index + $pendidikan->firstItem() }}</td>
                                <td>{{ $pen->user->nama_lengkap }}</td>
                                <td>
                                    @if ($pen->user->jenis_kelamin == 'L')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $pen->reffPendidikan->nama_pendidikan }}</td>
                                <td>{{ $pen->tahun_lulus }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $pen->id }}">
                                        Detail
                                    </button>
                                    <a href="{{ route('pendidikan.edit', $pen->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    @can('is-admin')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pen->id }}">
                                        Delete
                                    </button>
                                    <form id="delete-user-form-{{ $pen->id }}" action="{{ route('pendidikan.destroy',  $pen->id) }}" method="POST" style="display: none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                    @endcan
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{  $pen->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{  $pen->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{  $pen->id }}">Hapus data pendidikan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus data ini?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{  $pen->id }}').submit()">Hapus</button>
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


            {{ $pendidikan->appends(['search' => $searchQuery])->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($pendidikan as $pen)
        <div class="modal fade" id="imagesModal{{ $pen->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $pen->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $pen->id }}">Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 text-center">
                            <div class="col">
                                <p class="fw-bold">Gelar Depan:</p>
                                <p>{{ $pen->gelar_depan }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Gelar Belakang:</p>
                                <p>{{ $pen->gelar_belakang }}</p>
                            </div>
                        </div>
                        <div class="row mb-3 text-center">
                            <div class="col">
                                <p class="fw-bold">Nama Sekolah:</p>
                                <p>{{ $pen->nama_sekolah }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Program Studi/Jurusan:</p>
                                <p>{{ $pen->nama_jurusan }}</p>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <img src="{{ asset('ijazah/' . $pen->ijazah) }}" alt="Foto Ijazah" class="img-fluid mb-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('templates.footer')
@endsection
