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
                    <a href="{{ route('mobile.biodata.create') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Buat Profil</a>
                @endif

                @if (!$biodata->isEmpty())
                @foreach ($biodata as $bio)
                    <div class="mybet-single-card">
                        <div class="card-title">
                            <h6>Detail Biodata</h6>
                        </div>
                        <ul class="bet-details">
                            <button type="button" class="btn-c btn-gradient-03 btn-sm mb-2 mt-1">Data Diri</button>
                            <li><span>Nama Lengkap:</span><span>{{ $bio->user->nama_lengkap }}</span></li>
                            <li><span>Jenis Kelamin:</span><span>{{ $bio->user->jenis_kelamin === 'p' ? 'Perempuan' : 'Laki-laki' }}</span></li>
                            <li><span>Email:</span><span>{{ $bio->user->email }}</span></li>
                            <li><span>Telepon:</span><span>{{ $bio->telepon }}</span></li>
                            <li><span>Tempat Lahir:</span><span>{{ $bio->tempat_lahir }}</span></li>
                            <li><span>Tanggal Lahir:</span><span>{{ \Carbon\Carbon::parse($bio->tanggal_lahir)->format('d-m-Y') }}</span></li>
                            <li><span>Agama:</span><span>{{ $bio->agama }}</span></li>
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
