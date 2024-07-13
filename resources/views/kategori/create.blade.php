@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
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

        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf

            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="acara_id" class="form-label">Pilih Acara</label>
                    <select id="testSelect" name="acara_id">
                        <option value="">Pilih Acara</option>
                        @foreach($acara as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->nama_acara  }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="parent" class="form-label">Parent</label>
                    <input type="number" class="form-control" id="parent" name="parent"
                    value="{{ old('parent') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                    value="{{ old('nama_kategori') }}">
                </div>
                <div class="col-md-6">
                    <label for="desk_tambahan" class="form-label">Deskripsi Tambahan</label>
                    <input type="text" class="form-control" id="desk_tambahan" name="desk_tambahan"
                    value="{{ old('desk_tambahan') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Cancel</a>
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
