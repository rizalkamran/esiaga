@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('publik.anggota_peran.store') }}">
            @csrf

            <div class="row align-items-start mb-3">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID:</label>
                        <input type="text" class="form-control" name="user_id" id="user_id" value="{{ $user_id }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                        <div class="form-check">
                            <h6>Status</h6>
                            <input class="form-check-input" type="checkbox" name="status_aktif_peran" id="status_aktif_peran" checked disabled>
                            <label class="form-check-label" for="status_aktif_peran">Status Aktif Peran</label>
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <h6>Status</h6>
                        <input class="form-check-input" type="checkbox" name="status_verifikasi_peran" id="status_verifikasi_peran" disabled>
                        <label class="form-check-label" for="status_verifikasi_peran">Status Verifikasi Peran</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-start mb-3">
                <div class="col-md-6">
                    <div>
                        <label for="peran_id" class="form-label">Peran:</label>
                        <select class="form-select" name="peran_id" id="peran_id">
                            @foreach ($reffPerans as $peran)
                                <option value="{{ $peran->id }}">{{ $peran->nama_peran }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="cabor_id" class="form-label">Cabor:</label>
                        <select class="form-select" name="cabor_id" id="cabor_id">
                            @foreach ($reffCabors as $cabor)
                                <option value="{{ $cabor->id }}">{{ $cabor->nama_cabor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row align-items-start mb-3">
                <div class="col-md-6">
                    <div>
                        <label for="jabatan" class="form-label">Jabatan:</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ old('jabatan') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="nama_lembaga" class="form-label">Nama Lembaga:</label>
                        <input type="text" class="form-control" name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga') }}">
                    </div>
                </div>
            </div>

            <div class="row align-items-start mb-3">
                <div class="col-md-4">
                    <div>
                        <label for="provinsi_lembaga" class="form-label">Provinsi Lembaga:</label>
                        <input type="text" class="form-control" name="provinsi_lembaga" id="provinsi_lembaga" value="{{ old('provinsi_lembaga') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <label for="kota_lembaga" class="form-label">Kota Lembaga:</label>
                        <input type="text" class="form-control" name="kota_lembaga" id="kota_lembaga" value="{{ old('kota_lembaga') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <label for="kecamatan_lembaga" class="form-label">Kecamatan Lembaga:</label>
                        <input type="text" class="form-control" name="kecamatan_lembaga" id="kecamatan_lembaga" value="{{ old('kecamatan_lembaga') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@endsection
