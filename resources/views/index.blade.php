@extends('templates.main')

@section('content')

    @if (!Auth::check())
        <div class="text-center mt-3">
            <div class="row align-items-start">
                <div class="col-md-6">
                    <img style="width: 50%"
                        src="{{ asset('image/mobile/logo1_rm.png') }}"
                        class="img-fluid" alt="...">
                </div>
                <div class="col-md-6">
                    <p class="h3 text-danger">E-SIAGA</p>
                    <p class="h5 text-primary">APLIKASI PENINGKATAN PRESTASI OLAHRAGA</p>
                    <p class="lead">
                        Sebuah aplikasi yang diharapkan mampu memonitor berbagai aspek dalam peningkatan prestasi olahraga
                        para atlet wilayah Kalimantan Timur seperti aspek latihan fisik dan manajemen waktu.
                    </p>
                    <p class="btn btn-sm btn-success">
                        DINAS PEMUDA DAN OLAHRAGA PROV KALTIM
                    </p>

                    @if (Route::has('login'))
                        <div>
                            @auth
                            @else
                                <a class="btn btn-sm btn-outline-primary me-2" href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('register') }}">Register</a>
                                @endif

                            @endauth
                        </div>
                    @endif

                    {{-- <button type="button" class="btn btn-outline-primary">Login</button>
                <button type="button" class="btn btn-outline-primary">Register</button> --}}
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <p class="h3 text-primary mb-3">BERITA TERBARU</p>
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <div class="card border border-primary-subtle">
                        <img src="https://img.freepik.com/free-vector/news-concept-landing-page_52683-18598.jpg?w=740&t=st=1707902906~exp=1707903506~hmac=e4e80db4eefdcc9f0ee04acc69379b6587082422b82c87f13114f49e7a4283bd"
                            class="card-img-top mx-auto news-img">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-sm btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border border-primary-subtle">
                        <img src="https://img.freepik.com/free-vector/influencer-concept-illustration_114360-2680.jpg?w=740&t=st=1707903195~exp=1707903795~hmac=c09d94433465aab67aa3e42a1e159a1548d453ece8e6aca06d08cac649f58906"
                            class="card-img-top mx-auto news-img">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-sm btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border border-primary-subtle">
                        <img src="https://img.freepik.com/free-vector/news-concept-illustration_114360-5648.jpg?w=740&t=st=1707903246~exp=1707903846~hmac=974e9586a918c729b23dec50306bfb329ac79e3f8999d201ace9180d1841aa0f"
                            class="card-img-top mx-auto news-img">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-sm btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border border-primary-subtle">
                        <img src="https://img.freepik.com/free-vector/news-concept-landing-page_52683-20167.jpg?w=740&t=st=1707903305~exp=1707903905~hmac=4488afbe4468532fa073b91c64eb99d15734c6316186edff81844e74298844e1"
                            class="card-img-top mx-auto news-img">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-sm btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="text-center mt-3">
            <p class="h3 text-primary">Hasil pertandingan</p>
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <div class="card match-card border-danger">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <img src="https://img.freepik.com/free-vector/hand-drawn-soccer-logo-template_23-2149364523.jpg?w=740&t=st=1707904272~exp=1707904872~hmac=988ca67d92ead59b60f5428d94410c03ceddef00b049d0f572ef5612fe973c0c" alt="Team A Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team A</h6>
                            </div>
                            <div>
                                <h5 class="m-0">1 - 1</h5>
                              </div>
                            <div>
                              <img src="https://img.freepik.com/free-vector/hand-drawn-soccer-logo-template_23-2149364524.jpg?w=740&t=st=1707904372~exp=1707904972~hmac=5160e34091519b84bdd451f7c89ac286c17ff5a4d96b2de8ebfb0c5ed98e557a" alt="Team B Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team B</h6>
                            </div>
                          </div>
                          <hr>
                        <a href="#" class="btn btn-sm btn-primary">Match Review</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="card match-card border-danger">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <img src="https://img.freepik.com/free-vector/football-logo-background_1195-244.jpg?w=740&t=st=1707905088~exp=1707905688~hmac=57ca23d50811786df2f8ba465aecb89019bbe08a9cd5af1dd75f63bd7ab0e7b5" alt="Team A Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team C</h6>
                            </div>
                            <div>
                                <h5 class="m-0">2 - 1</h5>
                              </div>
                            <div>
                              <img src="https://img.freepik.com/free-vector/hand-drawn-sports-logo-template_23-2149437344.jpg?w=740&t=st=1707905109~exp=1707905709~hmac=c0ebfcf6e49baf1509e94a74a9bd7eb580f62277bd4bc08de4a2ec1d88c3f15b" alt="Team B Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team D</h6>
                            </div>
                          </div>
                          <hr>
                            <a href="#" class="btn btn-sm btn-primary">Match Review</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="card match-card border-danger">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <img src="https://img.freepik.com/free-vector/hand-drawn-soccer-logo-template_23-2149364523.jpg?w=740&t=st=1707904272~exp=1707904872~hmac=988ca67d92ead59b60f5428d94410c03ceddef00b049d0f572ef5612fe973c0c" alt="Team A Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team A</h6>
                            </div>
                            <div>
                                <h5 class="m-0">1 - 3</h5>
                              </div>
                            <div>
                              <img src="https://img.freepik.com/free-vector/hand-drawn-soccer-logo-template_23-2149364524.jpg?w=740&t=st=1707904372~exp=1707904972~hmac=5160e34091519b84bdd451f7c89ac286c17ff5a4d96b2de8ebfb0c5ed98e557a" alt="Team B Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team B</h6>
                            </div>
                          </div>
                          <hr>
                            <a href="#" class="btn btn-sm btn-primary">Match Review</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="card match-card border-danger">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <img src="https://img.freepik.com/free-vector/football-logo-background_1195-244.jpg?w=740&t=st=1707905088~exp=1707905688~hmac=57ca23d50811786df2f8ba465aecb89019bbe08a9cd5af1dd75f63bd7ab0e7b5" alt="Team A Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team C</h6>
                            </div>
                            <div>
                                <h5 class="m-0">0 - 2</h5>
                              </div>
                            <div>
                              <img src="https://img.freepik.com/free-vector/hand-drawn-sports-logo-template_23-2149437344.jpg?w=740&t=st=1707905109~exp=1707905709~hmac=c0ebfcf6e49baf1509e94a74a9bd7eb580f62277bd4bc08de4a2ec1d88c3f15b" alt="Team B Logo" class="club-icon">
                              <h6 class="card-title mt-1 m-0">Team D</h6>
                            </div>
                          </div>
                          <hr>
                            <a href="#" class="btn btn-sm btn-primary">Match Review</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    @endif

    @can('is-admin')
        @if (Auth::check())

        <div class="card-header">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">User</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Acara</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Referensi</button>
              </div>
        </div>

        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <div class="row mt-1 text-center">
                            <h5 class="text-secondary">Pengaturan User</h5>
                            <div class="col-md-4">
                                <a href="{{ route('admin.users.index') }}">
                                    <img src="{{ asset('icon/man.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Data user
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('biodata_admin.index') }}">
                                    <img src="{{ asset('icon/team.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Biodata User
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('diklat.index') }}">
                                    <img src="{{ asset('icon/group.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Diklat
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <div class="row mt-1 text-center">
                            <h5 class="text-secondary">Pengaturan Acara</h5>
                            <div class="col-md-4">
                                <a href="{{ route('acara.index') }}">
                                    <img src="{{ asset('icon/confer.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Daftar Acara
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('sesi_acara.index') }}">
                                    <img src="{{ asset('icon/session.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Data Sesi Acara
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('registrasi.index') }}">
                                    <img src="{{ asset('icon/regis.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Registrasi Peserta
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col-md-4">
                                <a href="{{ route('kehadiran.index') }}">
                                    <img src="{{ asset('icon/absent.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Kehadiran Peserta
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('tanda_terima.index') }}">
                                    <img src="{{ asset('icon/certif.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Tanda Terima
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#">
                                    <img src="{{ asset('icon/construct.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Menu belum tersedia
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <div class="row mt-1 text-center">
                            <h5 class="text-secondary">Data Referensi</h5>
                            <div class="col-md-3">
                                <a href="{{ route('cabor.index') }}">
                                    <img src="{{ asset('icon/sports.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Cabang Olahraga
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('peran.index') }}">
                                    <img src="{{ asset('icon/teacher.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Peran
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('data-provinsi.index') }}">
                                    <img src="{{ asset('icon/geo.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Provinsi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('data-kota.index') }}">
                                    <img src="{{ asset('icon/city.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Kota
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endcan

    @can('is-staf')
        @if (Auth::check())

        <div class="card-header">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">User</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Acara</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Referensi</button>
              </div>
        </div>

        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <div class="row mt-1 text-center">
                            <h5 class="text-secondary">Pengaturan User</h5>
                            <div class="col-md-4">
                                <a href="{{ route('staf.users.index') }}">
                                    <img src="{{ asset('icon/man.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Data user
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('staf.biodata.index') }}">
                                    <img src="{{ asset('icon/team.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Biodata User
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('diklat.index') }}">
                                    <img src="{{ asset('icon/group.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Diklat
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <div class="row mt-1 text-center">
                            <h5 class="text-secondary">Pengaturan Acara</h5>
                            <div class="col-md-4">
                                <a href="{{ route('acara.index') }}">
                                    <img src="{{ asset('icon/confer.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Daftar Acara
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('sesi_acara.index') }}">
                                    <img src="{{ asset('icon/session.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Data Sesi Acara
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('staf.registrasi.index') }}">
                                    <img src="{{ asset('icon/regis.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Registrasi Peserta
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col-md-4">
                                <a href="{{ route('kehadiran.index') }}">
                                    <img src="{{ asset('icon/absent.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Kehadiran Peserta
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('tanda_terima.index') }}">
                                    <img src="{{ asset('icon/certif.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Tanda Terima
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#">
                                    <img src="{{ asset('icon/construct.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Menu belum tersedia
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <div class="row mt-1 text-center">
                            <h5 class="text-secondary">Data Referensi</h5>
                            <div class="col-md-3">
                                <a href="{{ route('cabor.index') }}">
                                    <img src="{{ asset('icon/sports.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Cabang Olahraga
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('peran.index') }}">
                                    <img src="{{ asset('icon/teacher.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Peran
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('data-provinsi.index') }}">
                                    <img src="{{ asset('icon/geo.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Provinsi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('data-kota.index') }}">
                                    <img src="{{ asset('icon/city.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Kota
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endcan

    @can('is-non-publik')
        @if (Auth::check())
            <div class="card shadow mt-3">
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <h5 class="alert-heading">Peringatan !!!</h5>
                        <strong>Halaman ini khusus untuk level admin, sihlakan klik logout disebelah kanan atas</strong>
                        <hr>
                        Sihlakan pakai smartphone anda dan akses link <a href="https://e-siaga.com/aprizal/public/mobile-landing" class="alert-link" target="_blank">E-SIAGA</a>
                      </div>
                </div>
            </div>
        @endif
    @endcan

    @can('is-publik')
        @if (Auth::check())
            <div class="card shadow mt-3">
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <h5 class="alert-heading">Peringatan !!!</h5>
                        <strong>Halaman ini khusus untuk level admin, sihlakan klik logout disebelah kanan atas</strong>
                        <hr>
                        Sihlakan pakai smartphone anda dan akses link <a href="https://e-siaga.com/aprizal/public/mobile-landing" class="alert-link" target="_blank">E-SIAGA</a>
                      </div>
                </div>
            </div>
        @endif
    @endcan


    @include('templates.footer')

@endsection
