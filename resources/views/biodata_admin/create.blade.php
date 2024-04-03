@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Biodata
        </div>
        <div class="card-body">

            <div class="alert alert-primary" role="alert">
                <strong>Data yang wajib diisi -> Nama, Cabor, Kota Domisili, dan NPWP</strong>
            </div>

            <form action="{{ route('biodata_admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Display any validation errors here -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display success message if needed -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Nama</label>
                        <input class="form-control form-control-sm" list="datalistOptions1" id="user_id"
                            placeholder="Cari user" name="user_id" value="{{ old('user_id') }}">
                        <datalist id="datalistOptions1">
                            <datalist id="cabor">
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
                                @endforeach
                            </datalist>
                        </datalist>
                        <span id="display_user" class="badge text-bg-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="cabor_id" class="form-label">Cabang Olahraga</label>
                        <input class="form-control form-control-sm" list="datalistOptions2" id="cabor_id"
                            placeholder="Cari data Cabor" name="cabor_id" value="{{ old('cabor_id') }}">
                        <datalist id="datalistOptions2">
                            <datalist id="cabor">
                                @foreach ($cabor as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_cabor }}</option>
                                @endforeach
                            </datalist>
                        </datalist>
                        <span id="display_cabor" class="badge text-bg-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="kota_id" class="form-label">Kota Domisili</label>
                        <input class="form-control form-control-sm" list="datalistOptions3" id="kota_id"
                            placeholder="Cari data Cabor" name="kota_id" value="{{ old('kota_id') }}">
                        <datalist id="datalistOptions3">
                            <datalist id="kota_id">
                                @foreach ($kota as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                                @endforeach
                            </datalist>
                        </datalist>
                        <span id="display_kota" class="badge text-bg-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control form-control-sm" id="tempat_lahir" name="tempat_lahir"
                            value="{{ old('tempat_lahir') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-sm" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="nip_asn" class="form-label">NIP ASN</label>
                        <input type="number" class="form-control form-control-sm" id="nip_asn" name="nip_asn"
                            value="{{ old('nip_asn') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="number" class="form-control form-control-sm" id="npwp" name="npwp"
                            value="{{ old('npwp') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tempat_lahir" class="form-label">Agama</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="agama">
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
                    <div class="col-md-4">
                        <label for="tempat_lahir" class="form-label">Status Menikah</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="status_menikah">
                            <option selected disabled>Status Menikah</option>
                            <option value="Belum Menikah" {{ old('status_menikah') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old('status_menikah') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai Hidup" {{ old('status_menikah') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_menikah') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="gol_darah" class="form-label">Golongan Darah</label>
                        <input class="form-control form-control-sm" list="datalistOptions4" id="gol_darah" name="gol_darah"
                            placeholder="Cari golongan darah" value="{{ old('gol_darah') }}">
                        <datalist id="datalistOptions4">
                            <datalist id="goldarah">
                                <option selected disabled>Golongan darah</option>
                                <option value="O" {{ old('gol_darah') == 'O' ? 'selected' : '' }}>O</option>
                                <option value="O-" {{ old('gol_darah') == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="O+" {{ old('gol_darah') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="A" {{ old('gol_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="A-" {{ old('gol_darah') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="A+" {{ old('gol_darah') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="B" {{ old('gol_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="B-" {{ old('gol_darah') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="B+" {{ old('gol_darah') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="AB" {{ old('gol_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="AB-" {{ old('gol_darah') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="AB+" {{ old('gol_darah') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            </datalist>
                        </datalist>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tinggi_badan" class="form-label">Tinggi Badan</label>
                        <input type="number" class="form-control form-control-sm" id="tinggi_badan" name="tinggi_badan"
                            value="{{ old('tinggi_badan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="berat_badan" class="form-label">Berat Badan</label>
                        <input type="number" class="form-control form-control-sm" id="berat_badan" name="berat_badan"
                            value="{{ old('berat_badan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="hobi" class="form-label">Hobi</label>
                        <input type="text" class="form-control form-control-sm" id="hobi" name="hobi"
                            value="{{ old('hobi') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="alamat_jalan" class="form-label">Alamat (Jalan)</label>
                        <input type="text" class="form-control form-control-sm" id="alamat_jalan" name="alamat_jalan"
                            value="{{ old('alamat_jalan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="alamat_rt" class="form-label">Alamat (RT)</label>
                        <input type="number" class="form-control form-control-sm" id="alamat_rt" name="alamat_rt"
                            value="{{ old('alamat_rt') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="alamat_rw" class="form-label">Alamat (RW)</label>
                        <input type="number" class="form-control form-control-sm" id="alamat_rw" name="alamat_rw"
                            value="{{ old('alamat_rw') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control form-control-sm" id="kecamatan" name="kecamatan"
                            value="{{ old('kecamatan') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control form-control-sm" id="kelurahan" name="kelurahan"
                            value="{{ old('kelurahan') }}">
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="foto_diri" class="form-label">Foto Diri</label>
                        <input type="file" class="form-control form-control-sm" id="foto_diri" name="foto_diri">
                    </div>
                    <div class="col-md-4">
                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                        <input type="file" class="form-control form-control-sm" id="foto_ktp" name="foto_ktp">
                    </div>
                    <div class="col-md-4">
                        <label for="foto_npwp" class="form-label">Foto NPWP</label>
                        <input type="file" class="form-control form-control-sm" id="foto_npwp" name="foto_npwp">
                    </div>
                </div>

                <!-- Mandat File Upload -->
                <div class="mb-3">

                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('biodata_admin.index') }}">Cancel</a>
            </form>
        </div>
    </div>

    @include('templates.footer')

    <!-- JavaScript to handle input change -->
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

            // Hide display text initially
            document.getElementById('display_cabor').style.display = 'none';
            document.getElementById('display_kota').style.display = 'none';
            document.getElementById('display_user').style.display = 'none';

            // When the input gains focus (clicked)
            document.getElementById('cabor_id').addEventListener('focus', function() {
                document.getElementById('display_cabor').style.display = 'block';
            });

            document.getElementById('kota_id').addEventListener('focus', function() {
                document.getElementById('display_kota').style.display = 'block';
            });

            document.getElementById('user_id').addEventListener('focus', function() {
                document.getElementById('display_user').style.display = 'block';
            });

            // When an option is selected from the datalist
            document.getElementById('cabor_id').addEventListener('change', function() {
                updateDisplayText('cabor_id', 'display_cabor');
            });

            document.getElementById('kota_id').addEventListener('change', function() {
                updateDisplayText('kota_id', 'display_kota');
            });

            document.getElementById('user_id').addEventListener('change', function() {
                updateDisplayText('user_id', 'display_user');
            });
        });
    </script>
@endsection
