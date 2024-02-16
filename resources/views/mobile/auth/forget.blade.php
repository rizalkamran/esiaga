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
        <div class="forget-pass-page">
            <a class="btn back-page-btn" href="{{ route('mobile-login') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Lupa Password</h3>
            <p>Isi alamat email anda</p>
            <form class="default-form-wrap" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="email"><img src="{{ asset('image/mobile/icon/message.svg') }}" alt="img"></label>
                            <input name="email" type="email" class="form-control" placeholder="email_anda@contoh.com" id="email" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
            </form>
            <button class="btn btn-base w-100" type="submit">Kirim</button>
        </div>
    </div>



    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

@endsection
