@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Profil Anggota
        </div>
        <div class="card-body">

            @if (!$biodata->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Kontak/Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($biodata as $bio)
                            <tr>
                                <td>{{ $bio->user->nama_lengkap }}</td>
                                <td>{{ $bio->user->email }}</td>
                                <td>{{ $bio->telepon }}</td>
                                <td>
                                    @if ($bio->user->jenis_kelamin == 'L')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td>{{ $bio->agama }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $bio->id }}">
                                        Images
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#dataModal{{ $bio->id }}">
                                        Data
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
                    <p>Harap isi biodata terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $biodata->links() }}
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
                                <img src="{{ asset('storage/foto_diri/' . $bio->foto_diri) }}" alt="Foto Diri" class="img-fluid mb-3">
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/foto_ktp/' . $bio->foto_ktp) }}" alt="Foto KTP" class="img-fluid mb-3">
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/foto_npwp/' . $bio->foto_npwp) }}" alt="Foto NPWP" class="img-fluid mb-3">
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
                                <p>{{ $bio->alamat_jalan }}, RT: {{ $bio->alamat_rt }}, RW: {{ $bio->alamat_rw }}, {{ $bio->kelurahan }}, {{ $bio->kecamatan }}, {{ $bio->kota->nama_kota }}, {{ $bio->kota->provinsi->nama_provinsi }}</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold">Status:</p>
                                <p>{{ $bio->status_anggota }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p class="fw-bold">Request role:</p>
                                <p>{{ $bio->request_role }}</p>
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
