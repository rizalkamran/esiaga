@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.acara.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Daftar QR Code</h3>
        </div>

        <div class="mybet-page-wrap">
            <div class="container">

                <div class="alert alert-outline-danger" role="alert">
                    <strong>QRcode akan digunakan untuk absensi</strong>
                </div>

                <div class="table-responsive">
                    <table class="table uikit-table-1">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Acara</th>
                                <th scope="col">QR Code</th>
                            </tr>
                        </thead>
                        @foreach ($regis as $re)
                        <tbody class="align-middle">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ Illuminate\Support\Str::limit($re->acara->nama_acara, 30) }}</td>
                            <td class="text-center">
                                <button type="button" class="btn-c btn-sm btn-gradient-04 mb-2" data-bs-toggle="modal" data-bs-target="#modalqr-{{ $loop->index }}">
                                    Click
                                </button>
                            </td>
                        </tbody>

                        <!-- Modal Registrasi -->
                        <div class="modal fade" id="modalqr-{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">QR Code</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column align-items-center">
                                        <img src="{{ asset('qrcodes/registrasi/' . $re->qrcode_registrasi) }}" class="img-fluid">
                                        <span class="btn-c btn-sm btn-success mt-3">
                                            Berikan QRcode kepada Panitia ketika absensi
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-c btn-sm btn-secondary"data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal End-->
                        @endforeach

                    </table>
                </div>
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
