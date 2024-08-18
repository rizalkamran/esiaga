@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Galeri/Dokumentasi Acara
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

        <form method="POST" action="{{ route('galeri.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="acara_id" class="form-label">Pilih Acara</label>
                    <select id="testSelect" name="acara_id">
                        <option value="">Pilih Acara</option>
                        @foreach($acara as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->nama_acara  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                    value="{{ old('deskripsi') }}">
                </div>
                <div class="col-md-6">
                    <label for="dokumentasi" class="form-label">Foto/Dokumentasi</label>
                    <input type="file" class="form-control form-control-sm" id="dokumentasi" name="dokumentasi">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Cancel</a>
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
