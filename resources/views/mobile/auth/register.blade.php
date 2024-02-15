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
    <div class="align-items-center d-flex justify-content-center vh-100">
        <div class="register-page">
            <a class="btn back-page-btn" href="{{ route('mobile-intro') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Create an Account</h3>
            <p>Let’s us know what your name, email, and your password</p>
            <form class="default-form-wrap">
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input type="text" class="form-control" placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{ asset('image/mobile/icon/message.svg') }}" alt="img"></label>
                            <input type="email" class="form-control" placeholder="Enter your Phone number or email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{ asset('image/mobile/icon/password.svg') }}" alt="img"></label>
                            <input type="password" class="form-control" placeholder="Create Password">
                        </div>
                    </div>
                </div>
                <a class="btn btn-base w-100" href="term-condition.html">Sign Up</a>
            </form>

            <span class="another-way-link">Already have an account? <a href="{{ route('mobile-login') }}">Sign In</a></span>
        </div>
    </div>
</div>



<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
