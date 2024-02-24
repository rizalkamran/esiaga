@extends('templates.mobile')

@if (!Auth::check())
    @section('body_class', 'sc5')
    @section('content')
        <!-- preloader area start -->
        <div class="preloader" id="preloader">
            <div class="preloader-inner">
                <div id="wave1">
                </div>
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            </div>
        </div>
        <!-- preloader area end -->
        <div class="body-overlay" id="body-overlay"></div>

        <div class="main-page bg-main d-flex align-items-center justify-content-center vh-100">
            <div class="container">
                <div class="d-block text-center">

                </div>
                <div class="d-block text-center">
                    <img class="light-logo" src="{{ asset('image/mobile/logo-esiaga.png') }}" alt="img"
                        style="width: 70%; height:auto;">
                    <img class="darkmode-logo" src="{{ asset('image/mobile/logo-esiaga.png') }}" alt="img"
                        style="width: 70%; height:auto;">
                    <button type="button" class="btn-c btn-gradient-01 mt-3">DINAS PEMUDA DAN OLAHRAGA PROV KALTIM</button>
                    <a class="btn btn-white" href="{{ route('mobile-board') }}">KLIK DISINI</a>
                </div>
            </div>
        </div>

        <!-- back-to-top end -->
        <div class="back-to-top">
            <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
        </div>
    @endsection
@endif

@if (Auth::check())
    @section('body_class', 'sc5')
    @section('content')
        <div class="body-overlay" id="body-overlay"></div>

        <div class="container">
            <div class="main-home-area">
                <div class="profile-area">
                    <div class="media">
                        <a href="{{ route('mobile-profil') }}" class="thumb">
                            @if(Auth::user()->jenis_kelamin == 'L')
                                <img src="{{ asset('avatar/man.png') }}" alt="img" style="width: 50px; height: 50px;">
                            @elseif(Auth::user()->jenis_kelamin == 'P')
                                <img src="{{ asset('avatar/woman.png') }}" alt="img" style="width: 50px; height: 50px;">
                            @endif
                        </a>
                        <div class="media-body">
                            <span class="profile-name">{{ Auth::user()->nama_lengkap }}</span>
                            <span>
                                @foreach(Auth::user()->roles as $role)
                                    @if ($role->name === 'publik')
                                        Umum
                                    @elseif ($role->name === 'non-publik')
                                        Atlit/Pelatih/Guru
                                    @else
                                        {{ $role->name }}
                                    @endif
                                    @if (!$loop->last)
                                        , <!-- Add comma if it's not the last role -->
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <div class="btn-wrap">
                        <a class="icon-btn" href="#"><i class="ri-notification-3-line"></i> <span
                                class="badge">2</span></a>
                    </div>
                </div>

                <form class="edit-form-wrap">
                    <div class="single-input-wrap">
                        <label></label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </form>

                <div class="mybet-single-card">
                    <div class="card-title">
                        <h6>Halaman Dashboard</h6>
                    </div>
                    <div class="mt-2">
                        <p>Selamat datang di aplikasi E-SIAGA</p>
                    </div>
                </div>

                <ul class="profile-list-inner">
                    @can('is-non-publik')
                    <li>
                        <a class="single-profile-wrap" href="#"><i class="fa fa-book"></i> Pendidikan Formal <i class="ri-arrow-right-s-line"></i></a>
                    </li>
                    <li>
                        <a class="single-profile-wrap" href="{{ route('mobile.anggota.index') }}"><i class="fa fa-list"></i> Peran Anggota <i class="ri-arrow-right-s-line"></i></a>
                    </li>
                    <li>
                        <a class="single-profile-wrap" href="{{ route('mobile.diklat.index') }}"><i class="fa fa-tag"></i> Diklat <i class="ri-arrow-right-s-line"></i></a>
                    </li>
                    @endcan
                </ul>

                <div class="main-footer-bottom d-block text-center">
                    <ul>
                        <li>
                            <a class="active" href="{{ route('mobile-landing') }}">
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
                        @can('is-non-publik')
                            <li>
                                <a class="menu-bar" href="{{ route('mobile.acara.index') }}">
                                    <img src="{{ asset('image/mobile/icon/svg/ticket.svg') }}" alt="img">
                                    Acara
                                </a>
                            </li>
                        @endcan
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
        </div>
    @endsection
@endif
