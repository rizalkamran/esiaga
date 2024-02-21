@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('peran.store') }}">
            @csrf

            <div class="mb-3">
                <label for="nama_peran" class="form-label">Nama Peran</label>
                <input type="text" class="form-control form-control-sm" id="nama_peran" name="nama_peran">
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Create</button>
            <a href="{{ route('peran.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
        </form>
    </div>
</div>


@endsection
