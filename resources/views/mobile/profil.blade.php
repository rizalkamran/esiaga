@extends('templates.mobile')

@section('body_class', 'sc5')
@section('content')
    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area justify-content-between">
            <a class="btn back-page-btn" href="{{ route('mobile-landing') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ps-4">Profil/Biodata</h3>
        </div>

        <div class="container">
            <div class="my-profile-wrap">
                <div class="media">
                    <img class="thumb" src="{{ asset('image/mobile/comment/my-profile.png') }}" alt="img">
                    <div class="media-body">
                        <h6 class="profile-name">{{ Auth::user()->nama_lengkap }}</h6>
                        <p class="profile-mail">{{ Auth::user()->email }}</p>
                    </div>
                    <img class="star star1" src="{{ asset('image/mobile/icon/star.png') }}" alt="img">
                    <img class="star star2" src="{{ asset('image/mobile/icon/star.png') }}" alt="img">
                </div>
            </div>
        </div>

        <div class="container">
            <ul class="profile-list-inner">
                <li>
                    <a class="single-profile-wrap" href=#"><i class="fa fa-user"></i> Biodata <i class="ri-arrow-right-s-line"></i></a>
                </li>
                <li>
                    <div class="single-profile-wrap">
                        <i class="fas fa-cloud-moon"></i>
                        Dark/Light Mode
                        <div class="dark-area">
                            <label class="change-mode switch">
                                <input type="checkbox" data-active="true">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="single-profile-wrap" href="statistics.html"><i class="fas fa-chart-line"></i> Statistik <i class="ri-arrow-right-s-line"></i></a>
                </li>
                <li>
                    <a class="single-profile-wrap" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout/Keluar <i class="ri-arrow-right-s-line"></i></a>

                    <form method="POST" id="logout-form" action="{{ route('logout') }}" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
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
                    <a class="active" href="{{ route('mobile-profil') }}">
                        <img src="{{ asset('image/mobile/icon/svg/profile.svg') }}" alt="img">
                        Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
