@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-profil') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Peran Anggota</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <a href="{{ route('mobile.anggota.create') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Data baru</a>

                @if ($anggotaperan->isEmpty())
                <div class="alert alert-danger mt-3" role="alert">
                     Tidak ada data
                </div>
                @else
                    @foreach ($anggotaperan as $ap)
                        <div class="mybet-single-card">
                            <div class="card-title">
                                <h6>Detail Peran</h6>
                            </div>
                            <ul class="bet-details mt-3">
                                    <li><span>Nama Lengkap:</span><span>{{ $ap->user->nama_lengkap }}</span></li>
                                    <li><span>Peran:</span><span>{{ $ap->peran->nama_peran }}</span></li>
                                    <li><span>Cabor:</span><span>{{ $ap->cabor->nama_cabor }}</span></li>
                                    <li><span>Jabatan:</span><span>{{ $ap->jabatan }}</span></li>
                                    <li><span>Nama Lembaga:</span><span>{{ $ap->nama_lembaga }}</span></li>
                                    <li><span>Provinsi:</span><span>{{ $ap->provinsi_lembaga }}</span></li>
                                    <li><span>Kota:</span><span>{{ $ap->kota_lembaga }}</span></li>
                                    <li><span>Kecamatan:</span><span>{{ $ap->kecamatan_lembaga }}</span></li>
                            </ul>
                            <ul class="bet-status">
                                <li class="status-title">
                                    <span class="btn-c btn-sm {{ $ap->status_aktif_peran ? 'btn-success' : 'btn-danger' }}">
                                        {{ $ap->status_aktif_peran ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span class="btn-c btn-sm {{ $ap->status_verifikasi_peran ? 'btn-success' : 'btn-danger' }}">
                                        {{ $ap->status_verifikasi_peran ? 'Verified' : 'Not Verified' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    @endforeach
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
