@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('reff_pemenang.store') }}">
            @csrf

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control form-control-sm" id="deskripsi" name="deskripsi">
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Create</button>
            <a href="{{ route('reff_pemenang.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
        </form>
    </div>
</div>


@endsection
