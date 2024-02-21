@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.registrasi.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Daftar Acara</h3>
        </div>

        <div class="mybet-page-wrap">

            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-primary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                 @endif

                <form class="default-form-wrap" method="POST" action="{{ route('mobile.registrasi.store') }}">
                    @csrf
                    <div class="component-wrap mt-4">
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <select class="single-select w-100" name="acara_id">
                                    <option selected disabled>Pilih Acara</option>
                                    @foreach ($acara as $ac)
                                        <option value="{{ $ac->id }}">{{ Illuminate\Support\Str::limit($ac->nama_acara, 35) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"> <!-- Ensure this div has the appropriate column size -->
                            <button class="btn-c btn-primary mb-2" type="submit">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
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
