@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Update Biodata
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('biodata.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Hidden inputs for status_anggota and request_role -->
            <input type="hidden" name="status_anggota" value="0">
            <input type="hidden" name="request_role" value="0">

                <div class="row align-items-start mb-3">
                    <!-- User ID field -->
                    <div class="col-md-6">
                        <div>
                            <label for="user_id" class="form-label">User ID:</label>
                            <input type="text" class="form-control" name="user_id" id="user_id" value="{{ $user_id }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}">
                        @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row align-items-start mb-3">
                    <!-- Tempat Lahir field -->
                    <div class="col-md-6">
                        <div>
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Tanggal Lahir field -->
                    <div class="col-md-6">
                        <div>
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            <span id="formatted_start_date" class="badge bg-primary"></span>
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>



            <div class="row align-items-start mb-3">
                <!-- Agama field -->
                <div class="col-md-4">
                    <div>
                        <label for="agama" class="form-label">Agama:</label>
                        <select class="form-select @error('agama') is-invalid @enderror" name="agama" id="agama">
                            <option value="" selected>Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katholik" {{ old('agama') == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            <option value="Tidak" {{ old('agama') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- NIP ASN field -->
                <div class="col-md-4">
                    <div>
                        <label for="nip_asn" class="form-label">NIP ASN</label>
                        <input type="text" class="form-control @error('nip_asn') is-invalid @enderror" id="nip_asn" name="nip_asn" value="{{ old('nip_asn') }}">
                        @error('nip_asn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- NPWP field -->
                <div class="col-md-4">
                    <div>
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" value="{{ old('npwp') }}">
                        @error('npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start mb-3">
                <!-- Alamat (Jalan) field -->
                <div class="col-md-4">
                    <div>
                        <label for="alamat_jalan" class="form-label">Alamat (Jalan)</label>
                        <input type="text" class="form-control @error('alamat_jalan') is-invalid @enderror" id="alamat_jalan" name="alamat_jalan" value="{{ old('alamat_jalan') }}">
                        @error('alamat_jalan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Alamat (RT) field -->
                <div class="col-md-4">
                    <div>
                        <label for="alamat_rt" class="form-label">Alamat (RT)</label>
                        <input type="text" class="form-control @error('alamat_rt') is-invalid @enderror" id="alamat_rt" name="alamat_rt" value="{{ old('alamat_rt') }}">
                        @error('alamat_rt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Alamat (RW) field -->
                <div class="col-md-4">
                    <div>
                        <label for="alamat_rw" class="form-label">Alamat (RW)</label>
                        <input type="text" class="form-control @error('alamat_rw') is-invalid @enderror" id="alamat_rw" name="alamat_rw" value="{{ old('alamat_rw') }}">
                        @error('alamat_rw')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start mb-3">
                <!-- Kecamatan field -->
                <div class="col-md-6">
                    <div>
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                        @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Kelurahan field -->
                <div class="col-md-6">
                    <div>
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}">
                        @error('kelurahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row align-items-start mb-3">
                <!-- Foto Diri field -->
                <div class="col-md-4">
                    <div>
                        <label for="foto_diri" class="form-label">Foto Diri</label>
                        <input class="form-control @error('foto_diri') is-invalid @enderror" type="file" id="foto_diri" name="foto_diri">
                        @error('foto_diri')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Foto KTP field -->
                <div class="col-md-4">
                    <div>
                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                        <input class="form-control @error('foto_ktp') is-invalid @enderror" type="file" id="foto_ktp" name="foto_ktp">
                        @error('foto_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Foto NPWP field -->
                <div class="col-md-4">
                    <div>
                        <label for="foto_npwp" class="form-label">Foto NPWP</label>
                        <input class="form-control @error('foto_npwp') is-invalid @enderror" type="file" id="foto_npwp" name="foto_npwp">
                        @error('foto_npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start mb-3">
                <div class="col-md-6">
                    <div>
                        <label for="provinsi_id" class="form-label">Provinsi:</label>
                        <select class="selectcustom w-100" name="provinsi_id" id="provinsi_id" data-live-search="true">
                            <option value="" selected>Pilih</option>
                            @foreach ($provinsi as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="kota_id" class="form-label">Kota:</label>
                        <select class="selectcustom w-100" name="kota_id" id="kota_id" data-live-search="true">
                            <option value="" selected>Pilih</option>
                            @foreach ($kota as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection
