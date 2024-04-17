@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-landing') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Pendidikan</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <a href="{{ route('mobile.pendidikan.create') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Tambah</a>

                @if (!$pendidikan->isEmpty())

                    @foreach ($pendidikan as $index => $pen)
                        <div class="mybet-single-card mb-2">
                            <div class="card-title">
                                <h6>Data Diklat</h6>
                            </div>
                            <ul class="bet-details">
                                <li><span>Tingkat Pendidikan:</span><span>{{ $pen->reffPendidikan->nama_pendidikan }}</span></li>
                                <li><span>Gelar Depan:</span><span>{{ $pen->gelar_depan }}</span></li>
                                <li><span>Gelar Belakang:</span><span>{{ $pen->gelar_belakang }}</span></li>
                                <li><span>Nama Sekolah:</span><span>{{ $pen->nama_sekolah }}</span></li>
                                <li><span>Prodi/Jurusan:</span><span>{{ $pen->nama_jurusan }}</span></li>
                                <li><span>Tahun Lulus:</span><span>{{ $pen->tahun_lulus }}</span></li>
                            </ul>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn-c btn-gradient-05 btn-sm mb-2 mt-1"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $index }}">
                                        Ijazah
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Ijazah</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('ijazah/' . $pen->ijazah) }}" alt="Foto ijazah">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger mt-3" role="alert">
                        Tidak ada data
                    </div>
                @endif

            </div>
        </div>

        <div class="main-footer-bottom d-block text-center">
            <ul>
                <li>
                    <a class="active" href="{{ route('mobile-landing') }}">
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
                    <a class="menu-bar" href="{{ route('mobile.acara.index') }}">
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
