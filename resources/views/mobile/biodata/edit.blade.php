@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.biodata.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Update Biodata</h3>
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

                <form class="edit-form-wrap" method="POST" enctype="multipart/form-data" action="{{ route('mobile.biodata.update', $biodata->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="cabor_id">Cabang Olahraga</label>
                                <input type="text" class="form-control" list="cabor" id="cabor_id" placeholder="Isi Cabang Olahraga" name="cabor_id" value="{{ $biodata->cabor_id }}">
                                <datalist id="cabor">
                                    @foreach ($cabor as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama_cabor }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <p id="display_cabor" class="btn-c btn-sm btn-success mb-3">{{ $biodata->cabor->nama_cabor ?? '' }}</p>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kota_id">Kota Domisili</label>
                                <input type="text" class="form-control" list="datakota" id="kota_id" placeholder="Isi Kota Domisili" name="kota_id" value="{{ $biodata->kota_id }}">
                                <datalist id="datakota">
                                    @foreach ($kota as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <p id="display_kota" class="btn-c btn-sm btn-success mb-3">{{ $biodata->kota->nama_kota ?? '' }}</p>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Isi Data Tempat Lahir"
                                    id="tempat_lahir" name="tempat_lahir" value="{{ $biodata->tempat_lahir }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" placeholder="Isi Data Tanggal Lahir"
                                    id="tanggal_lahir" name="tanggal_lahir" value="{{ $biodata->tanggal_lahir }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nip_asn">NIP ASN</label>
                                <input type="number" class="form-control" placeholder="Isi Data NIP" id="nip_asn"
                                    name="nip_asn" value="{{ $biodata->nip_asn }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="npwp">NPWP</label>
                                <input type="number" class="form-control" placeholder="Isi Data NPWP" id="npwp"
                                    name="npwp" value="{{ $biodata->npwp }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="agama">
                                <option selected disabled>Pilih Agama</option>
                                <option value="Islam" {{ $biodata->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ $biodata->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katholik" {{ $biodata->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                <option value="Hindu" {{ $biodata->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ $biodata->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Konghucu" {{ $biodata->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                <option value="Tidak" {{ $biodata->agama == 'Tidak' ? 'selected' : '' }}>Tidak ada</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="gol_darah">Golongan Darah</label>
                                <input type="text" class="form-control" list="goldarah" id="gol_darah" placeholder="Isi Golongan Darah" name="gol_darah" value="{{ $biodata->gol_darah }}">
                                <datalist id="goldarah">
                                    <option disabled>Golongan darah</option>
                                    <option value="O">O</option>
                                    <option value="O-">O-</option>
                                    <option value="O+">O+</option>
                                    <option value="A">A</option>
                                    <option value="A-">A-</option>
                                    <option value="A+">A+</option>
                                    <option value="B">B</option>
                                    <option value="B-">B-</option>
                                    <option value="B+">B+</option>
                                    <option value="AB">AB</option>
                                    <option value="AB-">AB-</option>
                                    <option value="AB+">AB+</option>
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tinggi_badan">Tinggi Badan</label>
                                <input type="number" class="form-control" placeholder="Isi tinggi badan tanpa cm" id="tinggi_badan"
                                    name="tinggi_badan" value="{{ $biodata->tinggi_badan }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="berat_badan">Berat Badan</label>
                                <input type="number" class="form-control" placeholder="Isi Berat badan tanpa kg" id="berat_badan"
                                    name="berat_badan" value="{{ $biodata->berat_badan }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="status_menikah">
                                <option selected disabled>Status Menikah</option>
                                <option value="Belum Menikah" {{ $biodata->status_menikah == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="Menikah" {{ $biodata->status_menikah == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Cerai Hidup" {{ $biodata->status_menikah == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ $biodata->status_menikah == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="hobi">Hobi</label>
                                <input type="text" class="form-control" placeholder="Isi Hobi"
                                    id="hobi" name="hobi" value="{{ $biodata->hobi }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_jalan">Alamat (Jalan)</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Jalan" id="alamat_jalan"
                                    name="alamat_jalan" value="{{ $biodata->alamat_jalan }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_rt" class="form-label">RT</label>
                                <input type="text" class="form-control" placeholder="Isi RT" id="alamat_rt"
                                    name="alamat_rt" value="{{ $biodata->alamat_rt }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_rw" class="form-label">RW</label>
                                <input type="text" class="form-control" placeholder="Isi RW" id="alamat_rw"
                                    name="alamat_rw" value="{{ $biodata->alamat_rw }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" placeholder="Isi Kecamatan" id="kecamatan"
                                    name="kecamatan" value="{{ $biodata->kecamatan }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kelurahan">Kelurahan</label>
                                <input type="text" class="form-control" placeholder="Isi Kelurahan" id="kelurahan"
                                    name="kelurahan" value="{{ $biodata->kelurahan }}">
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
                        {{-- <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="upload_mandat">Mandat</label>
                                <input type="file" class="form-control" id="upload_mandat" name="upload_mandat"
                                    value="{{ old('upload_mandat') }}">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
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

    <!-- JavaScript to handle dynamic display updates -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update display text based on selected ID
            function updateDisplayText(inputId, displayId) {
                var inputElement = document.getElementById(inputId);
                var selectedId = inputElement.value;
                var optionText = '';

                // Loop through options in the datalist to find the corresponding text
                var options = inputElement.list.options;
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value === selectedId) {
                        optionText = options[i].text;
                        break; // Exit the loop once the option is found
                    }
                }

                // Update the text in the display element
                var displayElement = document.getElementById(displayId);
                displayElement.textContent = optionText;
            }

            // When an option is selected from the datalist
            document.getElementById('cabor_id').addEventListener('change', function() {
                updateDisplayText('cabor_id', 'display_cabor');
            });

            document.getElementById('kota_id').addEventListener('change', function() {
                updateDisplayText('kota_id', 'display_kota');
            });

            // Initially update display text
            updateDisplayText('cabor_id', 'display_cabor');
            updateDisplayText('kota_id', 'display_kota');
        });
    </script>
@endsection
