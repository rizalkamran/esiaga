@extends('templates.main')

@section('content')

    @if ($errors->any())
        <div class="alert alert-primary">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mt-3 border border-primary">
        <div class="card-header bg-primary text-white">
            Data Baru
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kode-acara.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="acara_id" class="form-label">Daftar Acara</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="acara_id">
                        <option selected disabled>Pilih Acara</option>
                        @foreach ($acara as $ac)
                            <option value="{{ $ac->id }}">{{ Illuminate\Support\Str::limit($ac->nama_acara, 35) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="code" class="form-label">Kode Acara</label>
                    <input type="text" class="form-control form-control-sm" id="code" name="code" value="{{ old('code') }}">
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Create</button>
                <a href="{{ route('kode-acara.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
            </form>
        </div>
    </div>


@endsection
