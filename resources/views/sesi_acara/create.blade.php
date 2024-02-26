@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Sesi Acara
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('sesi_acara.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="sesi" class="form-label">Daftar Acara</label>
                    <select class="form-select form-select-sm" aria-label="Default select example" name="acara_id">
                        <option selected>Pilih acara</option>
                        @foreach ($acara as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->nama_acara }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sesi" class="form-label">Nama Sesi</label>
                    <input type="text" class="form-control form-control-sm" id="sesi" name="sesi">
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Create</button>
                <a href="{{ route('sesi_acara.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
