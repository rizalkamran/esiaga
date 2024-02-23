@extends('templates.mobile')

@section('body_class', 'sc5-2')

@section('content')

<!-- preloader area start -->
{{--  <div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div id="wave1">
        </div>
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div> --}}
<!-- preloader area end -->
<div class="body-overlay" id="body-overlay"></div>

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

    @if(session('success'))
        <div class="alert alert-outline-primary alert-dismissible fade show mt-3 mb-2">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="align-items-center d-flex justify-content-center vh-100">

        <div class="register-page">
            <a class="btn back-page-btn" href="{{ route('mobile-intro') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Login</h3>
            <p>Gunakan username dan password</p>
            <form class="default-form-wrap" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="name"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="name" type="name" class="form-control" placeholder="Username" value="{{ old('name') }}" id="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="password"><img src="{{ asset('image/mobile/icon/password.svg') }}" alt="img"></label>
                            <input name="password" type="password" class="form-control" placeholder="Kata Sandi" id="password">
                        </div>
                    </div>
                    <div class="text-end"><a href="{{ route('mobile-forget') }}">Lupa Password?</a></div>
                </div>
                <button class="btn btn-base w-100" type="submit">Masuk</button>
            </form>

            <span class="another-way-link">Belum punya akun? <a href="{{ route('mobile.new-user.register') }}">Daftar</a></span>
        </div>
    </div>
</div>



<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
