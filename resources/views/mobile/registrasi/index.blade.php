@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.acara.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Registrasi</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <a href="{{ route('mobile.registrasi.create') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Daftar</a>

                @if ($anggota->isEmpty())
                <div class="alert alert-danger mt-3" role="alert">
                     Tidak ada data // Acara terdaftar
                </div>
                @else
                    @foreach ($anggota as $ag)
                        <div class="mybet-single-card">
                            <div class="card-title">
                                <h6>{{ $ag->acara->nama_acara }}</h6>
                            </div>
                            <ul class="bet-details mt-3">
                                <li><span>Nama Lengkap:</span><span>{{ $ag->user->nama_lengkap }}</span></li>
                                <li><span>Jenis Kelamin:</span><span>{{ $ag->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</span></li>
                                <li><span>Nama Lengkap:</span><span>{{ $ag->user->nomor_ktp }}</span></li>
                                <li><span>Tanggal daftar:</span><span>{{ $ag->created_at->format('d-m-Y H:i:s') }}</span></li>
                            </ul>
                            <ul class="bet-status">
                                <li class="status-title">
                                    <span>{{ \Carbon\Carbon::parse($ag->acara->tanggal_awal_acara)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($ag->acara->tanggal_akhir_acara)->format('d-m-Y') }}</span>
                                    <span class="btn-c btn-success btn-sm">Terdaftar</span>
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
                    <a class="menu-bar active" href="{{ route('mobile.acara.index') }}">
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
                    <a href="{{ route('mobile-profil') }}">
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
