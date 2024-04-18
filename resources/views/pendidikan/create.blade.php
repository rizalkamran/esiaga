@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Data Pendidikan
        </div>
        <div class="card-body">
            <form action="{{ route('pendidikan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                        @if(request()->has('user_id'))
                            <!-- If there is a user_id parameter in the URL -->
                            <label for="user_id" class="form-label">Nama Lengkap</label>
                            <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}" readonly>
                            <input type="text" value="{{ $user->first()->nama_lengkap }}" class="form-control form-control-sm" disabled>
                        @else
                        <label for="user_id" class="form-label">Nama</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="user_id">
                            <option selected disabled>Pilih user</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="tingkat" class="form-label">Tingkat Pendidikan</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="pendidikan_id">
                            <option selected disabled>Pilih Tingkat</option>
                            @foreach ($reff as $r)
                            <option value="{{ $r->id }}" {{ old('pendidikan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="gelar_depan" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control form-control-sm" id="gelar_depan" name="gelar_depan"
                            value="{{ old('gelar_depan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                        <input type="text" class="form-control form-control-sm" id="gelar_belakang" name="gelar_belakang"
                            value="{{ old('gelar_belakang') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control form-control-sm" id="tahun_lulus" name="tahun_lulus"
                            value="{{ old('tahun_lulus') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control form-control-sm" id="nama_sekolah" name="nama_sekolah"
                            value="{{ old('nama_sekolah') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nama_jurusan" class="form-label">Program Studi/Jurusan</label>
                        <input type="text" class="form-control form-control-sm" id="nama_jurusan" name="nama_jurusan"
                            value="{{ old('nama_jurusan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="ijazah" class="form-label">Foto Ijazah</label>
                        <input type="file" class="form-control form-control-sm" id="ijazah" name="ijazah">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('pendidikan.index') }}">Cancel</a>
            </form>
        </div>
    </div>

    @include('templates.footer')

@endsection
