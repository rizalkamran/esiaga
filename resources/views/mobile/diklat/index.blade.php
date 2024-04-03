@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-landing') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Diklat</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <a href="{{ route('mobile.diklat.create') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Tambah</a>

                @if (!$diklat->isEmpty())

                    @foreach ($diklat as $index => $d)
                        <div class="mybet-single-card mb-2">
                            <div class="card-title">
                                <h6>Data Diklat</h6>
                            </div>
                            <ul class="bet-details">
                                <li><span>Tingkat/Jumlah Jam:</span><span>{{ $d->tingkat }} // {{ $d->jumlah_jam }} jam</span></li>
                                <li><span>Nama Diklat:</span><span>{{ $d->nama_diklat }}</span></li>
                                <li>
                                    <span>Tanggal:</span>
                                    <span>{{ \Carbon\Carbon::parse($d->tgl_mulai)->format('d-m-Y') }} // {{ \Carbon\Carbon::parse($d->tgl_selesai)->format('d-m-Y') }}</span>
                                </li>
                                <li><span>Penyelenggara:</span><span>{{ $d->penyelenggara }}</span></li>
                            </ul>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn-c btn-gradient-05 btn-sm mb-2 mt-1"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $index }}">
                                        Ijazah/Sertifikat
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Foto</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('foto_ijazah/' . $d->foto_ijazah) }}" alt="Foto ijazah">
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
