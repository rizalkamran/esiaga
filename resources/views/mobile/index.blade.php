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
                    <img class="light-logo" src="{{ asset('image/mobile/logo1_rm.png') }}" alt="img"
                        style="width: 25%; height:auto;">
                    <img class="darkmode-logo" src="{{ asset('image/mobile/logo1_rm.png') }}" alt="img"
                        style="width: 25%; height:auto;">
                    <a class="btn btn-white" href="{{ route('mobile-intro') }}">KLIK DISINI</a>
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
                        <a href="profile.html" class="thumb">
                            <img src="{{ asset('image/mobile/profile.png') }}" alt="img">
                        </a>
                        <div class="media-body">
                            <span class="profile-name">{{ Auth::user()->nama_lengkap }}</span>
                        </div>
                    </div>
                    <div class="btn-wrap">
                        <a class="icon-btn" href="#"><i class="ri-search-line"></i></a>
                        <a class="icon-btn" href="#"><i class="ri-notification-3-line"></i> <span
                                class="badge">2</span></a>
                    </div>
                </div>

                <form class="edit-form-wrap">
                    <div class="single-input-wrap">
                        <label></label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                    <div class="single-input-wrap">
                        <label>E-SIAGA</label>
                        <input type="text" class="form-control" placeholder="Halaman dashboard">
                    </div>
                    <div class="single-input-wrap">
                        <label>Content 2</label>
                        <input type="text" class="form-control" placeholder="text content 2">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="single-input-wrap">
                                <label>Inline Content 1</label>
                                <input type="text" class="form-control" placeholder="Inline text 2">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="single-input-wrap">
                                <label>Inline Content 2</label>
                                <input type="text" class="form-control" placeholder="Inline text 2">
                            </div>
                        </div>
                    </div>
                </form>

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
                        <li>
                            <a class="menu-bar" href="#">
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
        </div>
    @endsection
@endif
