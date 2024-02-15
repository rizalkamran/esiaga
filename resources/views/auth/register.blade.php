@extends('templates.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-body border border-primary-subtle">
                        <h5 class="font-weight-light mt-1 text-primary-emphasis">REGISTER</h5>
                        <p class="text-secondary">**Sihlakan isi data/identitas anda</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-floating border border-primary-subtle mb-3">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Username" value="{{ old('name') }}">
                                        <label for="name" class="text-danger-emphasis">Username</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating border border-primary-subtle mb-3">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                                        <label for="email" class="text-danger-emphasis">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating border border-primary-subtle mb-3">
                                        <input name="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}">
                                        <label for="nama_lengkap" class="text-danger-emphasis">Nama Lengkap</label>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating border border-primary-subtle mb-3">
                                        <input name="nomor_ktp" type="text" class="form-control @error('nomor_ktp') is-invalid @enderror" id="nomor_ktp" placeholder="NIK" value="{{ old('nomor_ktp') }}">
                                        <label for="nomor_ktp" class="text-danger-emphasis">NIK</label>
                                        @error('nomor_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="text-primary-emphasis mb-1"><strong>Jenis Kelamin</strong></label><br>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" id="laki-laki" name="jenis_kelamin" value="L">
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="P">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating border border-primary-subtle mb-3">
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                <label for="password" class="text-danger-emphasis">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating border border-primary-subtle mb-3">
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                <label for="password_confirmation" class="text-danger-emphasis">Confirm Password</label>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                            <div class="text-center">
                                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
