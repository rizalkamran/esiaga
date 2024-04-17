@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.pendidikan.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Tambah Pendidikan</h3>
        </div>

        <div class="my-profile-detail">
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

                <form class="edit-form-wrap" method="POST" enctype="multipart/form-data" action="{{ route('mobile.pendidikan.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="display:none;">
                            <div class="single-input-wrap">
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control" placeholder="User ID" name="user_id"
                                    id="user_id" value="{{ $user_id }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="pendidikan_id">
                                <option selected disabled>Pilih Tingkat Pendidikan</option>
                                @foreach ($reff as $r)
                                <option value="{{ $r->id }}" {{ old('pendidikan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_pendidikan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Sekolah"
                                    id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_jurusan">Nama Jurusan</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Jurusan"
                                    id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tahun_lulus">Tahun Lulus</label>
                                <input type="number" class="form-control" placeholder="Contoh: 2015" id="tahun_lulus"
                                    name="tahun_lulus" value="{{ old('tahun_lulus') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="gelar_depan">Gelar Depan</label>
                                <input type="text" class="form-control" placeholder="Gelar Depan"
                                    id="gelar_depan" name="gelar_depan" value="{{ old('gelar_depan') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="gelar_belakang">Gelar Belakang</label>
                                <input type="text" class="form-control" placeholder="Gelar Belakang"
                                    id="gelar_belakang" name="gelar_belakang" value="{{ old('gelar_belakang') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="ijazah" class="form-label">Foto Ijazah/Sertifikat</label>
                                <input type="file" class="form-control" id="ijazah" name="ijazah"
                                    value="{{ old('ijazah') }}">
                            </div>
                        </div>

                        <div class="col-md-6"> <!-- Ensure this div has the appropriate column size -->
                            <button class="btn-c btn-primary mb-2" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
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
                    <a class="active" href="{{ route('mobile-profil') }}">
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
