@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-landing') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Acara</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <a href="{{ route('mobile.registrasi.index') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Registrasi</a>
                <a href="#" class="btn-c btn-sm btn-gradient-01 mb-2">Kehadiran</a>


                @foreach ($acaras as $acara)
                    <div class="mybet-single-card">
                        <div class="card-title">
                            <h6>{{ Illuminate\Support\Str::limit($acara['nama_acara'], 35) }}</h6>
                        </div>
                        <ul class="bet-details">
                            <li><span>Tanggal Mulai:</span><span>{{ \Carbon\Carbon::parse($acara['tanggal_awal_acara'])->format('d-m-Y') }}</span></li>
                            <li><span>Tanggal Selesai:</span><span>{{ \Carbon\Carbon::parse($acara['tanggal_akhir_acara'])->format('d-m-Y') }}</span></li>
                            <li><span>Lokasi:</span><span>{{ $acara['lokasi_acara'] }}</span></li>
                            <li><span>Tingkat:</span><span>{{ $acara['tingkat_wilayah_acara'] }}</span></li>
                        </ul>
                        <ul class="bet-status">
                            <li class="status-title">
                                <span></span>
                                @if ($acara['status_acara'] === 1)
                                    <span class="btn-c btn-success btn-sm">Active</span>
                                @else
                                    <span class="btn-c btn-danger btn-sm">Expired</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                @endforeach

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
