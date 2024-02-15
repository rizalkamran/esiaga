@extends('templates.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-body">
                        <h5 class="font-weight-light mt-1 text-primary-emphasis">LOGIN</h5>
                        <p class="text-secondary">**Masuk menggunakan email dan password anda</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating border border-primary-subtle my-3">
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                                <label for="email">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating border border-primary-subtle mb-3">
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Login <i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
                                </button>
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Password?</a>
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Daftar jika belum punya akun">
                                    Register <i class="fa-regular fa-id-card ms-1"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
