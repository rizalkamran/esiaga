@extends('templates.mobile')

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
            <img class="light-logo" src="{{ asset('image/mobile/logo1.png') }}" alt="img" style="width: 25%; height:auto;">
            <img class="darkmode-logo" src="{{ asset('image/mobile/logo1.png') }}" alt="img" style="width: 25%; height:auto;">
            <a class="btn btn-white" href="{{ route('mobile-intro') }}">KLIK DISINI</a>
        </div>
    </div>
</div>

<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
