@extends('templates.main')

@section('content')

<div class="card shadow mt-3">
    <div class="card-header">
        Data Biodata
    </div>
    <div class="card-body">
        <form action="{{ route('biodata_admin.update', $biodata) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            {{-- <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cabor_id" class="form-label">Cabang Olahraga</label>
                    <input class="form-control form-control-sm" list="datalistOptions" id="cabor_id" placeholder="Cari data Cabor" name="cabor_id" value="{{ $biodata->cabor_id }}">
                        <datalist id="datalistOptions">
                        <datalist id="cabor">
                            @foreach ($cabor as $c)
                                <option value="{{ $c->id }}">{{ $c->nama_cabor }}</option>
                            @endforeach
                        </datalist>
                    </datalist>
                </div>
                <div class="col-md-6">
                    <label for="kota_id" class="form-label">Kota Domisili</label>
                    <input class="form-control form-control-sm" list="datalistOptions2" id="kota_id" placeholder="Cari data Cabor" name="kota_id" value="{{ $biodata->kota_id }}">
                        <datalist id="datalistOptions2">
                        <datalist id="kota_id">
                            @foreach ($kota as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                            @endforeach
                        </datalist>
                    </datalist>
                </div>
            </div> --}}

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control form-control-sm" id="tempat_lahir" name="tempat_lahir" value="{{ $biodata->tempat_lahir }}">
                </div>
                <div class="col-md-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control form-control-sm" id="tanggal_lahir" name="tanggal_lahir" value="{{ $biodata->tanggal_lahir }}">
                </div>
                <div class="col-md-3">
                    <label for="nip_asn" class="form-label">NIP ASN</label>
                    <input type="number" class="form-control form-control-sm" id="nip_asn" name="nip_asn" value="{{ $biodata->nip_asn }}">
                </div>
                <div class="col-md-3">
                    <label for="npwp" class="form-label">NPWP</label>
                    <input type="number" class="form-control form-control-sm" id="npwp" name="npwp" value="{{ $biodata->npwp }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="tempat_lahir" class="form-label">Agama</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="agama">
                        <option value="Islam" {{ $biodata->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ $biodata->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katholik" {{ $biodata->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                        <option value="Hindu" {{ $biodata->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Budha" {{ $biodata->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                        <option value="Konghucu" {{ $biodata->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        <option value="Tidak" {{ $biodata->agama == 'Tidak' ? 'selected' : '' }}>Tidak ada</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tempat_lahir" class="form-label">Status Menikah</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="status_menikah">
                        <option value="Belum Menikah" {{ $biodata->status_menikah == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ $biodata->status_menikah == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Cerai Hidup" {{ $biodata->status_menikah == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ $biodata->status_menikah == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                    <input class="form-control form-control-sm" list="datalistOptions3" id="gol_darah" name="gol_darah" placeholder="Cari data Cabor" value="{{ $biodata->gol_darah }}">
                    <datalist id="datalistOptions3">
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
                    </datalist>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="tinggi_badan" class="form-label">Tinggi Badan</label>
                    <input type="number" class="form-control form-control-sm" id="tinggi_badan" name="tinggi_badan" value="{{ $biodata->tinggi_badan }}">
                </div>
                <div class="col-md-4">
                    <label for="berat_badan" class="form-label">Berat Badan</label>
                    <input type="number" class="form-control form-control-sm" id="berat_badan" name="berat_badan" value="{{ $biodata->berat_badan }}">
                </div>
                <div class="col-md-4">
                    <label for="hobi" class="form-label">Hobi</label>
                    <input type="text" class="form-control form-control-sm" id="hobi" name="hobi" value="{{ $biodata->hobi }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="alamat_jalan" class="form-label">Alamat (Jalan)</label>
                    <input type="text" class="form-control form-control-sm" id="alamat_jalan" name="alamat_jalan" value="{{ $biodata->alamat_jalan }}">
                </div>
                <div class="col-md-4">
                    <label for="alamat_rt" class="form-label">Alamat (RT)</label>
                    <input type="number" class="form-control form-control-sm" id="alamat_rt" name="alamat_rt" value="{{ $biodata->alamat_rt }}">
                </div>
                <div class="col-md-4">
                    <label for="alamat_rw" class="form-label">Alamat (RW)</label>
                    <input type="number" class="form-control form-control-sm" id="alamat_rw" name="alamat_rw" value="{{ $biodata->alamat_rw }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control form-control-sm" id="kecamatan" name="kecamatan" value="{{ $biodata->kecamatan }}">
                </div>
                <div class="col-md-6">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <input type="text" class="form-control form-control-sm" id="kelurahan" name="kelurahan" value="{{ $biodata->kelurahan }}">
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
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
            <a class="btn btn-sm btn-secondary" href="{{ route('biodata_admin.index') }}">Cancel</a>
        </form>
    </div>
</div>

@include('templates.footer')
@endsection
