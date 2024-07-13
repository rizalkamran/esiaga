@extends('templates.main')

@section('content')

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
                            <div class="col-md-3">
                                <a href="{{ route('admin.users.index') }}">
                                    <img src="{{ asset('icon/man.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Data user
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('biodata_admin.index') }}">
                                    <img src="{{ asset('icon/team.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Biodata User
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('diklat.index') }}">
                                    <img src="{{ asset('icon/group.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Diklat
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('pekerjaan.index') }}">
                                    <img src="{{ asset('icon/job.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Pekerjaan
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col-md-3">
                                <a href="{{ route('lisensi.index') }}">
                                    <img src="{{ asset('icon/license.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Lisensi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('pendidikan.index') }}">
                                    <img src="{{ asset('icon/graduate.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Pendidikan
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('prestasi.index') }}">
                                    <img src="{{ asset('icon/trophy.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Prestasi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('anggota_peran.index') }}">
                                    <img src="{{ asset('icon/raise.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Peran Anggota
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
                                <a href="{{ route('daftar_juara.index') }}">
                                    <img src="{{ asset('icon/winning.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Pemenang
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
                            <div class="col-md-4">
                                <a href="{{ route('peran.index') }}">
                                    <img src="{{ asset('icon/teacher.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Peran
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('data-provinsi.index') }}">
                                    <img src="{{ asset('icon/geo.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Provinsi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('data-kota.index') }}">
                                    <img src="{{ asset('icon/city.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Kota
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col-md-4">
                                <a href="{{ route('cabor.index') }}">
                                    <img src="{{ asset('icon/sports.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Cabang Olahraga
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('reffdidik.index') }}">
                                    <img src="{{ asset('icon/edu.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Tingkat Pendidikan
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('kategori.index') }}">
                                    <img src="{{ asset('icon/options.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Kategori Kejuaraan
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
                            <div class="col-md-3">
                                <a href="{{ route('staf.users.index') }}">
                                    <img src="{{ asset('icon/man.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Data user
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('staf.biodata.index') }}">
                                    <img src="{{ asset('icon/team.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Biodata User
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('diklat.index') }}">
                                    <img src="{{ asset('icon/group.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Diklat
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('pekerjaan.index') }}">
                                    <img src="{{ asset('icon/job.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Pekerjaan
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col-md-3">
                                <a href="{{ route('lisensi.index') }}">
                                    <img src="{{ asset('icon/license.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Lisensi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('pendidikan.index') }}">
                                    <img src="{{ asset('icon/graduate.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Pendidikan
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('prestasi.index') }}">
                                    <img src="{{ asset('icon/trophy.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Prestasi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('anggota_peran.index') }}">
                                    <img src="{{ asset('icon/raise.png') }}" style="width:25%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Peran Anggota
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
                                <a href="{{ route('daftar_juara.index') }}">
                                    <img src="{{ asset('icon/winning.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Daftar Pemenang
                                    </p>
                                </a>
                               {{--  <a href="#">
                                    <img src="{{ asset('icon/construct.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Menu belum tersedia
                                    </p>
                                </a> --}}
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
                            <div class="col-md-4">
                                <a href="{{ route('peran.index') }}">
                                    <img src="{{ asset('icon/teacher.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Peran
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('data-provinsi.index') }}">
                                    <img src="{{ asset('icon/geo.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Provinsi
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('data-kota.index') }}">
                                    <img src="{{ asset('icon/city.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Kota
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col-md-4">
                                <a href="{{ route('cabor.index') }}">
                                    <img src="{{ asset('icon/sports.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text" style="font-weight:bold;color:#0356b6;">
                                        Cabang Olahraga
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('reffdidik.index') }}">
                                    <img src="{{ asset('icon/edu.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Data Tingkat Pendidikan
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('kategori.index') }}">
                                    <img src="{{ asset('icon/options.png') }}" style="width:20%;border:none;"
                                        class="img-thumbnail">
                                    <p class="card-text text-wrap" style="font-weight:bold;color:#0356b6;">
                                        Kategori Kejuaraan
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

    @can('is-admin')
    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pemberitahuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success mt-2" role="alert">
                        <p>Untuk mempermudah mencari detail user, silakan akses ke menu <strong>"Data User"</strong> kemudian klik tombol <strong>"link"</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can('is-staf')
        <div class="modal" id="myModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pemberitahuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success mt-2" role="alert">
                            <p>Untuk mempermudah mencari detail user, silakan akses ke menu <strong>"Data User"</strong> kemudian klik tombol <strong>"link"</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @include('templates.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myModal').modal('show');

            setTimeout(function() {
                $('#myModal').modal('hide');
            }, 5500);
        });
    </script>

@endsection
