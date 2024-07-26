@extends('templates.main')

@section('content')


    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Tanda Terima
        </div>
        <div class="card-body">

            <!-- Display validation errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('tanda_terima.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="acara_id" class="form-label">Daftar Acara</label>
                            <select class="form-select" aria-label="Default select example" name="acara_id">
                                <option selected disabled>Pilih acara</option>
                                @foreach ($acara as $ac)
                                    <option value="{{ $ac->id }}" {{ old('acara_id') == $ac->id ? 'selected' : '' }}>{{ $ac->nama_acara }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Pilih Peserta/Atlit</label>
                            <select id="testSelect" name="user_id">
                                <option value="">Peserta/Atlit</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->nama_lengkap  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <h6>Tanda Terima</h6>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="status_baju" name="status_baju"
                            value="1" {{ old('status_baju') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_baju">Baju</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="status_sertifikat" name="status_sertifikat"
                            value="1" {{ old('status_sertifikat') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_sertifikat">Sertifikat</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="status_idcard" name="status_idcard"
                            value="1" {{ old('status_idcard') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_idcard">ID Card</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_terima" class="form-label">Tanggal Terima</label>
                            <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" value="{{ old('tgl_terima') }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Create</button>
                <a href="{{ route('tanda_terima.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect("#testSelect",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
</script>
