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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="align-items-center d-flex justify-content-center vh-100">
        <div class="register-page">
            <a class="btn back-page-btn mb-2" href="{{ route('mobile-profil') }}"><i class="ri-arrow-left-s-line"></i></a>
            <div class="mb-3">
                <h5>Update Profile</h5>
            </div>

            <form class="default-form-wrap" method="POST" action="{{ route('mobile.update.profile', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="name"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="name" type="text" class="form-control" placeholder="Buat Username" id="name"
                            value="{{ old('name') }}@isset($user){{ $user->name }}@endisset">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="nama_lengkap"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap" id="nama_lengkap"
                            value="{{ old('nama_lengkap') }}@isset($user){{ $user->nama_lengkap }}@endisset">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="nomor_ktp"><img src="{{ asset('image/mobile/icon/profile.svg') }}" alt="img"></label>
                            <input name="nomor_ktp" type="number" class="form-control" placeholder="NIK/Nomor KTP" id="nomor_ktp"
                            value="{{ old('nomor_ktp') }}@isset($user){{ $user->nomor_ktp }}@endisset">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="email"><img src="{{ asset('image/mobile/icon/message.svg') }}" alt="img"></label>
                            <input name="email" type="email" class="form-control" placeholder="Email" id="email"
                            value="{{ old('email') }}@isset($user){{ $user->email }}@endisset">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label for="telepon"><img src="{{ asset('image/mobile/icon/phone.svg') }}" alt="img"></label>
                            <input name="telepon" type="number" class="form-control" placeholder="Telepon" id="telepon"
                            value="{{ old('telepon') }}@isset($user){{ $user->telepon }}@endisset">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div>
                            <h6>Jenis Kelamin</h6>
                            <span class="form-radio d-inline-block ms-2 mx-2">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L"
                                {{ (old('jenis_kelamin') == 'L' || (isset($user) && $user->jenis_kelamin == 'L')) ? 'checked' : '' }}>
                                <label class="form-check-label ms-1" for="laki-laki"> </label>
                            </span>
                            Pria
                            <span class="form-radio d-inline-block ms-2 mx-2">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P"
                                {{ (old('jenis_kelamin') == 'P' || (isset($user) && $user->jenis_kelamin == 'P')) ? 'checked' : '' }}>
                                <label class="form-check-label ms-1" for="perempuan"></label>
                            </span>
                            Wanita
                        </div>
                    </div>

                </div>
                <button class="btn btn-base w-100" type="submit">Update</button>
            </form>

        </div>
    </div>
</div>



<!-- back-to-top end -->
<div class="back-to-top">
    <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
</div>

@endsection
