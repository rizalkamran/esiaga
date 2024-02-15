@extends('templates.main')

@section('content')
    <h1>Reset Password</h1>

    <form method="POST" action="{{ url('reset-password') }}">
        @csrf

        <div class="row align-items-start mb-3">
            <input type="hidden" name="token" value="{{ $request->token }}">
            <div class="col-md-6">
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ $request->email }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row align-items-start mb-3">
            <div class="col-md-6">
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label for="password_confirmation" class="form-label">Password Confirm</label>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
