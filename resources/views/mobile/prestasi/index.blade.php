@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile-landing') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Menu Prestasi</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <a href="{{ route('mobile.prestasi.create') }}" class="btn-c btn-sm btn-gradient-03 mb-2">Tambah</a>

                @if (!$prestasi->isEmpty())

                    @foreach ($prestasi as $index => $pres)
                        <div class="mybet-single-card mb-2">
                            <div class="card-title">
                                <h6>Data Prestasi - {{ $loop->iteration }}</h6>
                            </div>
                            <ul class="bet-details">
                                <li><span>Tipe Prestasi:</span><span>{{ $pres->tipe_prestasi }}</span></li>
                                <li><span>Cabang Olahraga:</span><span>{{ $pres->cabor->nama_cabor }}</span></li>
                                <li><span>Nama Event:</span><span>{{ $pres->nama_event }}</span></li>
                                <li><span>Nama Team:</span><span>{{ $pres->nama_team }}</span></li>
                                <li><span>Tahun:</span><span>{{ $pres->tahun }}</span></li>
                                <li><span>Rekor:</span><span>{{ $pres->rekor }}</span></li>

                            </ul>
                            <ul class="bet-status">
                                <li><span>Nomor:</span><span>{{ $pres->nomor_bukti_prestasi }}</span></li>
                                <li><span>Prestasi:</span><span>{{ $pres->prestasi }}</span></li>
                                <li><span>Catatan:</span><span>{{ $pres->catatan }}</span></li>
                            </ul>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn-c btn-gradient-05 btn-sm mb-2 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $index }}">
                                        Bukti Prestasi
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Bukti Prestasi</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('file_bukti_prestasi/' . $pres->file_bukti_prestasi) }}" alt="Foto Prestasi">
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
