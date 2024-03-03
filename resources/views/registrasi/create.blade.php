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

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('registrasi.store.admin') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label for="user_id" class="form-label">Data User</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="user_id">
                        <option selected disabled>Pilih User</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <!-- Event dropdown/select -->
                    <label for="acara_id" class="form-label">Pilih Acara</label>
                    <select name="acara_id" class="form-control form-control-sm" id="acara_id">
                        <option value="">Pilih Acara</option>
                        @foreach($acara as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->nama_acara }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm mt-3">Create</button>
            <a href="{{ route('registrasi.index') }}" class="btn btn-secondary btn-sm mt-3">Cancel</a>
        </form>
    </div>
</div>
@endsection
