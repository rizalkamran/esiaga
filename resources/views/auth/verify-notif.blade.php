@extends('templates.main')

@section('content')
    <h1>Access Denied !!!</h1>
    <p>Verify your email first !!!</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">
            Resend Verification Email
        </button>
    </form>

@endsection
