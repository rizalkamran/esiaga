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

    <div class="container">
        <div class="align-items-center d-flex justify-content-center vh-100">

            <div class="row">
                <h4 class="mb-2 text-center">E-SIAGA</h4>
                <div class="col-xl-6 mb-4">

                    <!-- Begin Basic Accordion -->
                    <div class="accordion uik-accordion-inner" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>SELAMAT DATANG</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="text-center">
                                        <img src="{{ asset('image/mobile/onboard/1.png') }}" alt="img" style="width: 75%; height: auto;">
                                    </div>
                                    <p class="mt-3 text-center">
                                        Aplikasi Peningkatan Prestasi Olahraga Wilayah Kaltim ini menyediakan akses terkait data keolahragaan di wilayah Kaltim
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong>Data Atlet dan Kejuaraan</strong>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="text-center">
                                        <img src="{{ asset('image/mobile/onboard/2.png') }}" alt="img" style="width: 75%; height: auto;">
                                    </div>
                                    <p class="mt-3 text-center">
                                        Terdapat Data Atlet dan Calon Atlet dari kalangan pelajar serta kejuaraan nasional maupun internasional yang dapat diakses secara realtime
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>Pelatihan Pelatih</strong>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="text-center">
                                        <img src="{{ asset('image/mobile/onboard/3.png') }}" alt="img" style="width: 75%; height: auto;">
                                    </div>
                                    <p class="mt-3 text-center">
                                        Tersedia Jadwal Pelatihan Pelatih yang Diselenggarakan Rutin Oleh Dispora Prov Kaltim
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-base w-100 mt-4" href="{{ route('mobile-intro') }}">Mulai</a>
                    <!-- End Basic Accordion -->
                </div>
            </div>
        </div>
    </div>


    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

@endsection
