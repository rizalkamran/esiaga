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

    <div class="align-items-center d-flex justify-content-center vh-100">

        <div class="register-page">
            <a class="btn back-page-btn" href="{{ route('mobile-intro') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Login</h3>
            <p>Gunakan email dan password</p>
            <form class="default-form-wrap" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="email"><img src="{{ asset('image/mobile/icon/message.svg') }}" alt="img"></label>
                            <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" id="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="password"><img src="{{ asset('image/mobile/icon/password.svg') }}" alt="img"></label>
                            <input name="password" type="password" class="form-control" placeholder="Password" id="password">
                        </div>
                    </div>
                </div>
                <button class="btn btn-base w-100" type="submit">Masuk</button>
            </form>

            <span class="another-way-link">Belum punya akun? <a href="{{ route('mobile-register') }}">Daftar</a></span>
        </div>
    </div>
</div>



<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
