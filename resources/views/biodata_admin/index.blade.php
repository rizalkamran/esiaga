@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Profil/Biodata
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" href="{{ route('biodata_admin.create', ['user_id' => request()->query('user_id')]) }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('biodata_admin.index') }}">Reset</a>
                        {{-- <button class="btn btn-warning dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item" href="{{ route('biodata_admin.index', ['sort_by' => 'id', 'sort_order' => 'asc', 'search' => $searchQuery]) }}">ID</a></li>
                            <li><a class="dropdown-item" href="{{ route('biodata_admin.index', ['sort_by' => 'user_id', 'sort_order' => ($sortField == 'nama_lengkap' && $sortOrder == 'asc') ? 'desc' : 'asc', 'search' => $searchQuery]) }}">Nama Lengkap</a></li>
                            <li><a class="dropdown-item" href="{{ route('biodata_admin.index', ['sort_by' => 'cabor_id', 'sort_order' => ($sortField == 'nama_cabor' && $sortOrder == 'asc') ? 'desc' : 'asc', 'search' => $searchQuery]) }}">Nama Cabang Olahraga</a></li>
                            <!-- Add more sorting options as needed -->
                        </ul> --}}
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('biodata_admin.index') }}" method="get" style="display: inline-flex; align-items: center;">
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

            @if (!$biodata->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                <a href="{{ route('biodata_admin.index', ['sort_by' => 'nama_lengkap', 'sort_order' => ($sortField == 'nama_lengkap' && $sortOrder == 'asc') ? 'desc' : 'asc', 'search' => $searchQuery]) }}">
                                    Nama Lengkap
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('biodata_admin.index', ['sort_by' => 'nama_cabor', 'sort_order' => ($sortField == 'nama_cabor' && $sortOrder == 'asc') ? 'desc' : 'asc', 'search' => $searchQuery]) }}">
                                    Cabor
                                </a>
                            </th>
                            <th>Kontak/Telepon</th>
                            <th>L/P</th>
                            <th>Agama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($biodata as $bio)
                            <tr>
                                <td>{{ ($biodata->currentPage() - 1) * $biodata->perPage() + $loop->iteration }}</td>
                                <td>{{ $bio->user->nama_lengkap }}</td>
                                <td>{{ $bio->cabor->nama_cabor }}</td>
                                <td>{{ $bio->user->telepon }}</td>
                                <td>
                                    @if ($bio->user->jenis_kelamin == 'L')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $bio->agama }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $bio->id }}">
                                        Lampiran
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#dataModal{{ $bio->id }}">
                                        Detail
                                    </button>
                                    <a href="{{ route('biodata_admin.edit', $bio->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $bio->id }}">
                                        Delete
                                    </button>
                                    <form id="delete-user-form-{{ $bio->id }}" action="{{ route('biodata_admin.destroy',  $bio->id) }}" method="POST" style="display: none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{  $bio->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{  $bio->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{  $bio->id }}">Hapus biodata</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus data ini?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{  $bio->id }}').submit()">Hapus</button>
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
                    <p>tidak ada biodata</p>
                </div>
            @endif


            {{ $biodata->appends(['search' => $searchQuery, 'sort_by' => $sortField, 'sort_order' => $sortOrder])->links() }}

           {{--  {{ $biodata->onEachSide(1)->appends(['search' => $searchQuery])->links() }} --}}

            <div>
                <div class="row">
                    <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $biodata->total() }}</p>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <p class="btn btn-sm btn-secondary">Data/Page: {{ $biodata->count() }} / {{ $biodata->currentPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($biodata as $bio)
        <div class="modal fade" id="imagesModal{{ $bio->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $bio->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $bio->id }}">Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <p>Foto Diri</p>
                                <img src="{{ asset('biodata/foto_diri/' . $bio->foto_diri) }}" alt="Foto Diri" class="img-fluid mb-3">
                            </div>
                            <div class="col-md-4">
                                <p>Foto KTP</p>
                                <img src="{{ asset('biodata/foto_ktp/' . $bio->foto_ktp) }}" alt="Foto KTP" class="img-fluid mb-3">
                            </div>
                            <div class="col-md-4">
                                <p>Foto NPWP</p>
                                <img src="{{ asset('biodata/foto_npwp/' . $bio->foto_npwp) }}" alt="Foto NPWP" class="img-fluid mb-3">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Data Modals -->
    @foreach ($biodata as $bio)
        <div class="modal fade" id="dataModal{{ $bio->id }}" tabindex="-1"
            aria-labelledby="dataModalLabel{{ $bio->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataModalLabel{{ $bio->id }}">Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <p class="fw-bold">Tempat Lahir:</p>
                                <p>{{ $bio->tempat_lahir }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Tanggal Lahir:</p>
                                <p>{{ \Carbon\Carbon::parse($bio->tanggal_lahir)->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p class="fw-bold">NIP ASN:</p>
                                <p>{{ $bio->nip_asn }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">NPWP:</p>
                                <p>{{ $bio->npwp }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p class="fw-bold">Alamat:</p>
                                <p>{{ $bio->alamat_jalan }}, RT: {{ $bio->alamat_rt }}, RW: {{ $bio->alamat_rw }}, {{ $bio->kelurahan }}, {{ $bio->kecamatan }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Kota Domisili:</p>
                                <p>{{ $bio->kota->nama_kota }} , {{ $bio->kota->provinsi->nama_provinsi }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p class="fw-bold">Golongan Darah:</p>
                                <p>{{ $bio->gol_darah }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Status Menikah:</p>
                                <p>{{ $bio->status_menikah }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p class="fw-bold">Tinggi Badan:</p>
                                <p>{{ $bio->tinggi_badan }} cm</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Berat Badan:</p>
                                <p>{{ $bio->berat_badan }} kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('templates.footer')
@endsection
