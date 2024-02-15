@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('cabor.store') }}">
            @csrf

            <div class="mb-3">
                <label for="nama_cabor" class="form-label">Nama Cabang Olahraga</label>
                <input type="text" class="form-control" id="nama_cabor" name="nama_cabor">
            </div>

            <div class="mb-3">
                <label for="deskripsi_cabor" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi_cabor" name="deskripsi_cabor" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('cabor.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>


@endsection
