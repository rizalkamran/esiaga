@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.anggota.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Edit Data</h3>
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

                <form class="edit-form-wrap" method="POST" action="{{ route('mobile.anggota.update', $anggota->id) }}">
                    @csrf
                    @method('PUT') <!-- Use PUT method for update -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="peran_id">
                                <option selected disabled>Pilih Peran</option>
                                @foreach ($reffPerans as $peran)
                                    <option value="{{ $peran->id }}"
                                        {{ $anggota->peran_id == $peran->id ? 'selected' : '' }}>
                                        {{ $peran->nama_peran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="cabor_id">Pilih Cabor</label>
                                <input type="text" class="form-control" list="data1" id="cabor_id"
                                    placeholder="Isi Cabor" name="cabor_id" value="{{ $anggota->cabor_id }}">
                                <datalist id="data1">
                                    @foreach ($reffCabors as $cabor)
                                        <option value="{{ $cabor->id }}">{{ $cabor->nama_cabor }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <!-- Add remaining fields here and pre-fill them with existing data -->
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="jabatan" class="form-label">Jabatan:</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan"
                                    placeholder="Isi data jabatan" value="{{ $anggota->jabatan }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_lembaga" class="form-label">Nama Lembaga:</label>
                                <input type="text" class="form-control" name="nama_lembaga" id="nama_lembaga"
                                    placeholder="Isi nama lembaga" value="{{ $anggota->nama_lembaga }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="provinsi_lembaga" class="form-label">Provinsi Lembaga:</label>
                                <input type="text" class="form-control" name="provinsi_lembaga" id="provinsi_lembaga"
                                    placeholder="Isi provinsi" value="{{ $anggota->provinsi_lembaga }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kota_lembaga" class="form-label">Kota Lembaga:</label>
                                <input type="text" class="form-control" name="kota_lembaga" id="kota_lembaga"
                                    placeholder="Isi Kota" value="{{ $anggota->kota_lembaga }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kecamatan_lembaga" class="form-label">Kecamatan Lembaga:</label>
                                <input type="text" class="form-control" name="kecamatan_lembaga" id="kecamatan_lembaga"
                                    placeholder="Isi Kecamatan" value="{{ $anggota->kecamatan_lembaga }}">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <button class="btn-c btn-primary mb-2" type="submit">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
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
