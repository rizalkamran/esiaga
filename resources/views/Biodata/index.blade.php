@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Profil Anggota
        </div>
        <div class="card-body">
            @can('logged-in')
                @if ($biodata->isEmpty())
                    <a class="btn btn-sm btn-primary mb-3" href="{{ route('biodata.create') }}" role="button">Create</a>
                @endif
            @endcan

            @if (!$biodata->isEmpty())
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($biodata as $bio)
                        <div class="col-md-6">
                            <div class="card h-100 shadow border border-success-subtle">
                                <div class="card-header bg-success text-white">
                                    <h6 class="card-title mb-0">Data diri</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <p class="fw-bold">Nama Lengkap:</p>
                                            <p>{{ $bio->user->nama_lengkap }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="fw-bold">Email/Kontak:</p>
                                            <p>{{ $bio->user->email }}</p>
                                            <p>{{ $bio->telepon }}</p>
                                        </div>
                                    </div>
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
                                            <p class="fw-bold">Agama:</p>
                                            <p>{{ $bio->agama }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="fw-bold">Jenis Kelamin:</p>
                                            @if ($bio->user->jenis_kelamin == 'L')
                                                <span class="badge bg-primary">Laki-laki</span>
                                            @else
                                                <span class="badge bg-danger">Perempuan</span>
                                            @endif
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
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 shadow border border-danger-subtle">
                                <div class="card-header bg-danger text-white">
                                    <h6 class="card-title mb-0">Alamat</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            {{-- <p class="fw-bold">Asal Provinsi - Kota:</p>
                                            <p>
                                                <span class="badge bg-success">
                                                    {{ $bio->provinsi->nama_provinsi }}
                                                </span>
                                            </p> --}}
                                            <p>
                                                <span class="badge bg-success">
                                                    {{ $bio->kota->nama_kota }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="fw-bold">Alamat:</p>
                                            <p>{{ $bio->alamat_jalan }}</p>
                                            <p>RT: {{ $bio->alamat_rt }}</p>
                                            <p>RW: {{ $bio->alamat_rw }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <p class="fw-bold">Kecamatan:</p>
                                            <p>{{ $bio->kecamatan }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="fw-bold">Kelurahan:</p>
                                            <p>{{ $bio->kelurahan }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <p class="fw-bold">Status:</p>
                                            <p>{{ $bio->status_anggota }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="fw-bold">Request role:</p>
                                            <p>{{ $bio->request_role }}</p>
                                        </div>
                                    </div>
                                    <div class="float-start">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $bio->id }}"
                                            data-foto-diri="{{ asset($bio->foto_diri) }}"
                                            data-foto-ktp="{{ asset($bio->foto_ktp) }}"
                                            data-foto-npwp="{{ asset($bio->foto_npwp) }}">
                                            Detail Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

    <!-- Modals -->
    @foreach ($biodata as $bio)
        <div class="modal fade" id="exampleModal{{ $bio->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $bio->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $bio->id }}">Bukti Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Foto Diri: <img src="{{ asset('storage/foto_diri/' . $bio->foto_diri) }}" alt="Foto Diri"></p>
                        <p>Foto KTP: <img src="{{ asset('storage/foto_ktp/' . $bio->foto_ktp) }}" alt="Foto KTP"></p>
                        <p>Foto NPWP: <img src="{{ asset('storage/foto_npwp/' . $bio->foto_npwp) }}" alt="Foto NPWP"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
