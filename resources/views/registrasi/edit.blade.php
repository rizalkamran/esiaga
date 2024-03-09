@extends('templates.main')

@section('content')

<div class="card shadow mt-3">
    <div class="card-header">
        Data Update
    </div>
    <div class="card-body">
        <form action="{{ route('registrasi.update', $anggotaAcaraRegistrasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Mandat File Upload -->
            <div class="mb-3">
                <label for="mandat" class="form-label">Mandat File (PDF)</label>
                <input type="file" class="form-control form-control-sm" id="mandat" name="mandat">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
            <a href="{{ route('registrasi.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@include('templates.footer')
@endsection
