@extends('templates.mobile')

@section('body_class', 'sc5-2')

@section('content')

<!-- preloader area start -->
{{-- <div class="preloader" id="preloader">
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

<div class="login-page">
    <div class="container">
        <div class="align-items-center d-flex justify-content-center vh-100">
            <div>
                <div class="logo-area text-center">
                    <img class="light-logo" src="{{ asset('image/mobile/logo1_rm.png') }}" alt="img" style="width: 25%; height:auto;">
                    <img class="darkmode-logo" src="{{ asset('image/mobile/logo1_rm.png') }}" alt="img" style="width: 25%; height:auto;">
                </div>
                <h3>E-SIAGA</h3>
                <p>Sihlakan login dengan akun anda, atau daftar akun baru</p>
                <a class="btn btn-base w-100" href="{{ route('mobile-login') }}">Punya akun? Login</a>
                <a class="btn btn-border w-100 mt-4" href="{{ route('mobile-terms') }}">Buat akun baru</a>
            </div>
        </div>
    </div>
</div>

<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
