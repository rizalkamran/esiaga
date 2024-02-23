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
                    @if (Auth::user()->jenis_kelamin == 'L')
                        <img class="thumb" src="{{ asset('avatar/man.png') }}" alt="img"
                            style="width: 60px; height: 60px;">
                    @elseif(Auth::user()->jenis_kelamin == 'P')
                        <img class="thumb" src="{{ asset('avatar/woman.png') }}" alt="img"
                            style="width: 60px; height: 60px;">
                    @endif
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

            @if (session('error'))
                <div class="alert alert-outline-danger alert-dismissible fade show mt-3 mb-2">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <ul class="profile-list-inner">
                @can('is-non-publik')
                    <li>
                        <a class="single-profile-wrap"
                            href="{{ Auth::user()->biodata ? route('mobile.biodata.index') : route('mobile.biodata.create') }}">
                            <i class="fa fa-user"></i> Biodata <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </li>
                @endcan
                <li>
                    <a class="single-profile-wrap" href="{{ route('mobile.anggota.index') }}"><i class="fa fa-list"></i>
                        Peran Anggota <i class="ri-arrow-right-s-line"></i></a>
                </li>
                <li>
                    <a class="single-profile-wrap" href="{{ route('mobile-setting') }}"><i class="fa fa-wrench"></i>
                        Pengaturan <i class="ri-arrow-right-s-line"></i></a>
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
                    <a class="active" href="{{ route('mobile-profil') }}">
                        <img src="{{ asset('image/mobile/icon/svg/profile.svg') }}" alt="img">
                        Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
