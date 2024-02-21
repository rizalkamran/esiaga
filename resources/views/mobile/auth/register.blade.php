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
            <h3>Daftar Akun</h3>
            <p>Sihlakan isi data diri anda</p>
            <form class="default-form-wrap" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="nama_lengkap"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="nomor_ktp"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="nomor_ktp" type="text" class="form-control" placeholder="NIK/Nomor KTP" id="nomor_ktp" value="{{ old('nomor_ktp') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="email"><img src="{{ asset('image/mobile/icon/message.svg') }}" alt="img"></label>
                            <input name="email" type="email" class="form-control" placeholder="Email" id="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="col-md-6 mt-2">
                        <div class="single-input-wrap">
                            <label for="name"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="name" type="text" class="form-control" placeholder="Username" id="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="password"><img src="{{ asset('image/mobile/icon/password.svg') }}" alt="img"></label>
                            <input name="password" type="password" class="form-control" placeholder="Kata Sandi" id="password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="password_confirmation"><img src="{{ asset('image/mobile/icon/password.svg') }}" alt="img"></label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Ulangi Kata Sandi" id="password_confirmation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Jenis Kelamin</h5>
                        <div class="ba-all-page-inner mb-4 p-3">
                            <span class="form-radio d-inline-block ms-2 mx-2">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L">
                                <label class="form-check-label ms-1" for="laki-laki"> </label>
                            </span>
                            Pria
                            <span class="form-radio d-inline-block ms-2 mx-2">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P">
                                <label class="form-check-label ms-1" for="perempuan"></label>
                            </span>
                            Wanita
                        </div>
                    </div>
                </div>
                <button class="btn btn-base w-100" type="submit">Daftar</button>
            </form>

            <span class="another-way-link">Sudah punya akun? <a href="{{ route('mobile-login') }}">Masuk/login</a></span>
        </div>
    </div>
</div>



<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
