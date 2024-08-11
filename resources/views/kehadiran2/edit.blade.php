@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Edit data kehadiran
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

        <form method="POST" action="{{ route('kehadiran2.update', $kehadiran->id) }}">
            @csrf
            @method('PUT') <!-- Add this line to set the HTTP method as PUT -->

            <div class="row">
                <div class="col-md-6">
                    <label for="user_id" class="form-label">Data User</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $kehadiran->user->nama_lengkap }}" disabled>
                </div>
                <div class="col-md-6">
                    <!-- Display current Sesi Acara (session) data -->
                    <label for="sesi_acara_id" class="form-label">Sesi Acara</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $kehadiran->sesiAcara->sesi }}" disabled>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <!-- Display current created_at data -->
                    <label for="created_at" class="form-label">Waktu hadir</label>
                    <input type="datetime-local" class="form-control form-control-sm" name="created_at" step="1" value="{{ $kehadiran->created_at->format('Y-m-d\TH:i:s') }}">
                </div>
            </div>

            <!-- You can add more fields here if needed -->

            <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
            <a href="{{ route('kehadiran2.index') }}" class="btn btn-secondary btn-sm mt-3">Cancel</a>
        </form>
    </div>
</div>
@endsection
