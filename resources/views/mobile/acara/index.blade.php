@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-landing') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Acara</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                @if ($errors->any())
                    <div class="alert alert-primary alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-outline-primary alert-dismissible fade show mt-3 mb-2">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-outline-danger alert-dismissible fade show mt-3 mb-2">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- <a href="{{ route('mobile.registrasi.index') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Registrasi</a> --}}

                @can('is-non-publik')
                    <button type="button" class="btn-c btn-sm btn-gradient-03 mb-2" data-bs-toggle="modal"
                        data-bs-target="#modalregis">Registrasi</button>
                    <button type="button" class="btn-c btn-sm btn-gradient-03 mb-2" data-bs-toggle="modal"
                        data-bs-target="#modalabsen">Kehadiran</button>
                @endcan

                @foreach ($acaras as $acara)
                    <div class="mybet-single-card">
                        <div class="card-title">
                            <h6>{{ Illuminate\Support\Str::limit($acara['nama_acara'], 35) }}</h6>
                        </div>
                        <ul class="bet-details">
                            <li><span>Tanggal
                                    Mulai:</span><span>{{ \Carbon\Carbon::parse($acara['tanggal_awal_acara'])->format('d-m-Y') }}</span>
                            </li>
                            <li><span>Tanggal
                                    Selesai:</span><span>{{ \Carbon\Carbon::parse($acara['tanggal_akhir_acara'])->format('d-m-Y') }}</span>
                            </li>
                            <li><span>Lokasi:</span><span>{{ $acara['lokasi_acara'] }}</span></li>
                            <li><span>Tingkat:</span><span>{{ $acara['tingkat_wilayah_acara'] }}</span></li>
                        </ul>
                        @can('is-non-publik')
                            @if ($acara->isRegisteredByUser(auth()->id()))
                                <span class="btn-c btn-sm btn-success">Terdaftar</span>
                            @else
                                <span class="btn-c btn-sm btn-danger">Tidak Terdaftar</span>
                            @endif
                            @if ($acara->anggotaKehadiranRegistrasi->contains('user_id', auth()->id()))
                                <span class="btn-c btn-sm btn-info">Absen</span>
                            @endif
                        @endcan
                    </div>
                @endforeach

                <!-- Modal Registrasi -->
                <div class="modal fade" id="modalregis" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel">Registrasi</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Update the route name in your view to match the existing route name -->
                                <form c action="{{ route('mobile.acara.register') }}" method="POST">
                                    @csrf
                                    <select class="single-select w-100" name="acara_id">
                                        <option selected disabled>Pilih Acara</option>
                                        @foreach ($acaras as $ac)
                                            <option value="{{ $ac->id }}">
                                                {{ Illuminate\Support\Str::limit($ac->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>

                                    <div class="float-end mt-3">
                                        <button type="button" class="btn-c btn-sm btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn-c btn-sm btn-primary" type="submit">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal End-->

                <!-- Modal absen -->
                <div class="modal fade" id="modalabsen" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel">Kehadiran</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="edit-form-wrap" action="{{ route('mobile.acara.kehadiran') }}" method="POST">
                                    @csrf
                                    <div class="single-input-wrap">
                                        <label for="security_pass">Security</label>
                                        <input type="password" class="form-control" placeholder="Isi Security Pass"
                                            id="security_pass" name="security_pass" value="{{ old('security_pass') }}">
                                    </div>

                                    <select class="single-select w-100" name="acara_id">
                                        <option selected disabled>Pilih Acara</option>
                                        @foreach ($acaras as $ac)
                                            <option value="{{ $ac->id }}">
                                                {{ Illuminate\Support\Str::limit($ac->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="float-end mt-3">
                                        <button type="button" class="btn-c btn-sm btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn-c btn-sm btn-primary" type="submit">Absen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal End-->

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
