@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Peran Anggota
        </div>
        <div class="card-body">
            <form action="{{ route('anggota_peran.update', $anggota_peran) }}" method="POST" enctype="multipart/form-data">
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cabor_id" class="form-label">Cabor</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="cabor_id">
                            @foreach ($cabor as $c)
                                <option value="{{ $c->id }} {{ $anggota_peran->cabor_id ==  $c->id ? 'selected' : '' }}">{{ $c->nama_cabor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="peran_id" class="form-label">Cabor</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="peran_id">
                            @foreach ($peran as $p)
                                <option value="{{ $p->id }} {{ $anggota_peran->peran_id ==  $p->id ? 'selected' : '' }}">{{ $p->nama_peran }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan"
                            value="{{ $anggota_peran->jabatan }}">
                    </div>
                    <div class="col-md-6">
                        <label for="nama_lembaga" class="form-label">Nama Lembaga</label>
                        <input type="text" class="form-control form-control-sm" id="nama_lembaga" name="nama_lembaga"
                            value="{{ $anggota_peran->nama_lembaga }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="provinsi_lembaga" class="form-label">Provinsi Lembaga</label>
                        <input type="text" class="form-control form-control-sm" id="provinsi_lembaga" name="provinsi_lembaga"
                            value="{{ $anggota_peran->provinsi_lembaga }}">
                    </div>
                    <div class="col-md-4">
                        <label for="kota_lembaga" class="form-label">Kota Lembaga</label>
                        <input type="text" class="form-control form-control-sm" id="kota_lembaga" name="kota_lembaga"
                            value="{{ $anggota_peran->kota_lembaga }}">
                    </div>
                    <div class="col-md-4">
                        <label for="kecamatan_lembaga" class="form-label">Kecamatan Lembaga</label>
                        <input type="text" class="form-control form-control-sm" id="kecamatan_lembaga" name="kecamatan_lembaga"
                            value="{{ $anggota_peran->kecamatan_lembaga }}">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('anggota_peran.index') }}">Cancel</a>
            </form>
        </div>
    </div>

    @include('templates.footer')

@endsection
