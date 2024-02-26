@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-profil') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Biodata</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                @if ($biodata->isEmpty())
                    <a href="{{ route('mobile.biodata.create') }}" class="btn-c btn-sm btn-gradient-01 mb-2">Buat Profil</a>
                @endif

                @if (!$biodata->isEmpty())

                @foreach ($biodata as $bio)
                    <a href="{{ route('mobile.biodata.edit', $bio->id) }}" class="btn-c btn-sm btn-gradient-01 mb-2">Edit Biodata</a>
                    <div class="mybet-single-card">
                        <div class="card-title">
                            <h6>Detail Biodata</h6>
                        </div>
                        <ul class="bet-details">
                            <button type="button" class="btn-c btn-gradient-03 btn-sm mb-2 mt-1">Data Diri</button>
                            <li><span>Nama Lengkap:</span><span>{{ $bio->user->nama_lengkap }}</span></li>
                            <li><span>Jenis Kelamin:</span><span>{{ $bio->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</span></li>
                            <li><span>Email:</span><span>{{ $bio->user->email }}</span></li>
                            <li><span>Telepon:</span><span>{{ $bio->user->telepon }}</span></li>
                            <li><span>Tempat Lahir:</span><span>{{ $bio->tempat_lahir }}</span></li>
                            <li><span>Tanggal Lahir:</span><span>{{ \Carbon\Carbon::parse($bio->tanggal_lahir)->format('d-m-Y') }}</span></li>
                            <li><span>Cabor:</span><span>{{ $bio->cabor->nama_cabor }}</span></li>
                            <li><span>Agama:</span><span>{{ $bio->agama }}</span></li>
                            <li><span>Golongan Darah:</span><span>{{ $bio->gol_darah }}</span></li>
                            <li><span>Tinggi Badan:</span><span>{{ $bio->tinggi_badan }} cm</span></li>
                            <li><span>Berat Badan:</span><span>{{ $bio->berat_badan }} kg</span></li>
                            <li><span>Status Menikah:</span><span>{{ $bio->status_menikah }}</span></li>
                            <li><span>Hobi:</span><span>{{ $bio->hobi }}</span></li>
                        </ul>
                        <ul class="bet-details">
                            <button type="button" class="btn-c btn-gradient-04 btn-sm mb-2 mt-1">Data Alamat</button>
                            <li><span>Jalan:</span><span>{{ $bio->alamat_jalan }}</span></li>
                            <li><span>RT:</span><span>{{ $bio->alamat_rt }}</span></li>
                            <li><span>RW:</span><span>{{ $bio->alamat_rw }}</span></li>
                            <li><span>Kecamatan:</span><span>{{ $bio->kecamatan }}</span></li>
                            <li><span>Kelurahan:</span><span>{{ $bio->kelurahan }}</span></li>
                            <li><span>Kota:</span><span>{{ $bio->kota->nama_kota }}</span></li>
                            <li><span>Provinsi:</span><span>{{ $bio->kota->provinsi->nama_provinsi }}</span></li>
                        </ul>
                        <ul class="bet-details">
                            <button type="button" class="btn-c btn-gradient-05 btn-sm mb-2 mt-1">Data Validasi</button>
                            <li><span>NIK:</span><span>{{ $bio->user->nomor_ktp }}</span></li>
                            <li><span>NIP ASN:</span><span>{{ $bio->nip_asn }}</span></li>
                            <li><span>NPWP:</span><span>{{ $bio->npwp }}</span></li>
                        </ul>
                        <ul class="bet-details">
                            <button type="button" class="btn-c btn-gradient-05 btn-sm mb-2 mt-1">Foto</button>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn-c btn-gradient-02 btn-sm mb-2 mt-1" data-bs-toggle="modal" data-bs-target="#modal1">
                                        Foto Diri
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn-c btn-gradient-02 btn-sm mb-2 mt-1" data-bs-toggle="modal" data-bs-target="#modal2">
                                        Foto KTP
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn-c btn-gradient-02 btn-sm mb-2 mt-1" data-bs-toggle="modal" data-bs-target="#modal3">
                                        Foto NPWP
                                    </button>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Foto Diri</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/foto_diri/' . $bio->foto_diri) }}" alt="Foto Diri">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-c btn-sm bg-red text-white" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Foto Diri</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/foto_ktp/' . $bio->foto_ktp) }}" alt="Foto Diri">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-c btn-sm bg-red text-white" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Foto Diri</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/foto_npwp/' . $bio->foto_npwp) }}" alt="Foto Diri">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-c btn-sm bg-red text-white" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="alert alert-danger mt-3" role="alert">
                        Tidak ada data
                    </div>
                @endif

            </div>
        </div>

        <div class="main-footer-bottom d-block text-center">
            <ul>
                <li>
                    <a href="{{ route('mobile-landing') }}">
                        <img src="{{ asset('image/mobile/icon/svg/home.svg') }}" alt="icon">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('image/mobile/icon/svg/sports.svg') }}" alt="img">
                        Olahraga
                    </a>
                </li>
                <li>
                    <a class="menu-bar" href="{{ route('mobile.acara.index') }}">
                        <img src="{{ asset('image/mobile/icon/svg/ticket.svg') }}" alt="img">
                        Acara
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('image/mobile/icon/svg/document.svg') }}" alt="img">
                        Berita
                    </a>
                </li>
                <li>
                    <a class="active" href="{{ route('mobile-profil') }}">
                        <img src="{{ asset('image/mobile/icon/svg/profile.svg') }}" alt="img">
                        Profil
                    </a>
                </li>
            </ul>
        </div>

    </div>



    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

@endsection
