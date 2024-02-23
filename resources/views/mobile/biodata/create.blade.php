@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.biodata.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Buat Biodata</h3>
        </div>

        <div class="my-profile-detail">
            <div class="container">

                @if(session('error'))
                    <div class="alert alert-outline-danger alert-dismissible fade show mt-3 mb-2">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-primary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="edit-form-wrap" method="POST" enctype="multipart/form-data" action="{{ route('mobile.biodata.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control" placeholder="User ID" name="user_id"
                                    id="user_id" value="{{ $user_id }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Isi Data Tempat Lahir"
                                    id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" placeholder="Isi Data Tanggal Lahir"
                                    id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nip_asn">NIP ASN</label>
                                <input type="text" class="form-control" placeholder="Isi Data NIP" id="nip_asn"
                                    name="nip_asn" value="{{ old('nip_asn') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="npwp">NPWP</label>
                                <input type="text" class="form-control" placeholder="Isi Data NPWP" id="npwp"
                                    name="npwp" value="{{ old('npwp') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="agama">
                                <option selected disabled>Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katholik" {{ old('agama') == 'Katholik' ? 'selected' : '' }}>Katholik
                                </option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                                <option value="Tidak" {{ old('agama') == 'Tidak' ? 'selected' : '' }}>Tidak ada</option>
                            </select>
                        </div>

                        {{-- <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="provinsi_id" id="provinsi_id">
                                <option selected disabled>Pilih Asal Provinsi</option>
                                @foreach ($provinsi as $pro)
                                    <option value="{{ $pro->id }}">{{ $pro->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kota_id">Kota Domisili</label>
                                <input type="text" class="form-control" list="datakota" id="kota_id" placeholder="Isi Kota Domisili" name="kota_id">
                                <datalist id="datakota">
                                    @foreach ($kota as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_jalan">Alamat (Jalan)</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Jalan" id="alamat_jalan"
                                    name="alamat_jalan" value="{{ old('alamat_jalan') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_rt" class="form-label">RT</label>
                                <input type="text" class="form-control" placeholder="Isi RT" id="alamat_rt"
                                    name="alamat_rt" value="{{ old('alamat_rt') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_rw" class="form-label">RW</label>
                                <input type="text" class="form-control" placeholder="Isi RW" id="alamat_rw"
                                    name="alamat_rw" value="{{ old('alamat_rw') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" placeholder="Isi Kecamatan" id="kecamatan"
                                    name="kecamatan" value="{{ old('kecamatan') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kelurahan">Kelurahan</label>
                                <input type="text" class="form-control" placeholder="Isi Kelurahan" id="kelurahan"
                                    name="kelurahan" value="{{ old('kelurahan') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="foto_diri" class="form-label">Foto Diri</label>
                                <input type="file" class="form-control" id="foto_diri" name="foto_diri"
                                    value="{{ old('foto_diri') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="foto_ktp">Foto KTP</label>
                                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp"
                                    value="{{ old('foto_ktp') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="foto_npwp">Foto NPWP</label>
                                <input type="file" class="form-control" id="foto_npwp" name="foto_npwp"
                                    value="{{ old('foto_npwp') }}">
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
