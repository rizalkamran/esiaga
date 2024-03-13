@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Absen Acara
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

        <form method="POST" action="{{ route('absen.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-4" style="display:none">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" name="user_id" value="{{ request()->query('user_id') }}" class="form-control" readonly>
                    <!-- This field is readonly and automatically filled with the user_id from the QR code -->
                </div>
                <div class="col-md-4" style="display:none">
                    <label for="acara_id" class="form-label">Acara ID</label>
                    <input type="text" name="acara_id" value="{{ request()->query('acara_id') }}" class="form-control" readonly>
                    <!-- This field is readonly and automatically filled with the acara_id from the QR code -->
                </div>
                <div class="col-md-4">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" value="{{ $user->nama_lengkap }}" class="form-control" disabled>
                    <!-- This field is disabled and displays the nama_lengkap of the user -->
                </div>
                <div class="col-md-4">
                    <label for="nama_acara" class="form-label">Nama Acara</label>
                    <input type="text" value="{{ $acara->nama_acara }}" class="form-control" disabled>
                    <!-- This field is disabled and displays the nama_acara of the event -->
                </div>
                <div class="col-md-4">
                    <!-- Session dropdown/select -->
                    <label for="sesi_acara_id" class="form-label">Pilih Sesi Acara</label>
                    <select name="sesi_acara_id" class="form-control form-control-sm" id="sesi_acara_id">
                        <option value="">Pilih Sesi Acara</option>
                        <!-- Populate session options filtered by selected event -->
                        @foreach($sesiAcara as $session)
                            @if ($session->acara_id == request()->query('acara_id'))
                                <option value="{{ $session->id }}">{{ $session->sesi }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm mt-3">Create</button>
        </form>
    </div>
</div>

<script>
    // Get references to the event and session select elements
    const eventSelect = document.getElementById('acara_id');
    const sessionSelect = document.getElementById('sesi_acara_id');

    // Add change event listener to the event select
    eventSelect.addEventListener('change', (event) => {
        const selectedEventId = event.target.value;

        // Hide all session options
        for (let i = 0; i < sessionSelect.options.length; i++) {
            const option = sessionSelect.options[i];
            option.style.display = 'none';
        }

        // Show session options associated with the selected event
        const selectedEventOptions = document.querySelectorAll('.sesi-acara-' + selectedEventId);
        selectedEventOptions.forEach(option => {
            option.style.display = 'block';
        });
    });
</script>

@endsection
