@extends('templates.main')

@section('content')
    <h1>Reset Password</h1>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection
