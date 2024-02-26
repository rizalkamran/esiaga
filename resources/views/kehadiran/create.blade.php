@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('kehadiran.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label for="user_id" class="form-label">Data User</label>
                    <input class="form-control" list="listuser" id="user_id" placeholder="Daftar user" name="user_id">
                        <datalist id="listuser">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                            @endforeach
                        </datalist>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <!-- Event dropdown/select -->
                    <label for="acara_id" class="form-label">Pilih Acara</label>
                    <select name="acara_id" class="form-control" id="acara_id">
                        <option value="">Pilih Acara</option>
                        @foreach($acara as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->nama_acara }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <!-- Session dropdown/select -->
                    <label for="sesi_acara_id" class="form-label">Pilih Sesi Acara</label>
                    <select name="sesi_acara_id" class="form-control" id="sesi_acara_id">
                        <option value="">Pilih Sesi Acara</option>
                        <!-- Populate all session options -->
                        @foreach($sesiAcara as $session)
                            <option value="{{ $session->id }}" class="sesi-option sesi-acara-{{ $session->acara_id }}">{{ $session->sesi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <button type="submit" class="btn btn-primary btn-sm mt-3">Create</button>
            <a href="{{ route('kehadiran.index') }}" class="btn btn-secondary btn-sm mt-3">Cancel</a>
        </form>
    </div>
</div>

<script>
    // Get references to the event and session select elements
    const eventSelect = document.getElementById('acara_id');
    const sessionOptions = document.querySelectorAll('.sesi-option');

    // Add change event listener to the event select
    eventSelect.addEventListener('change', (event) => {
        const selectedEventId = event.target.value;

        // Hide all session options
        sessionOptions.forEach(option => {
            option.style.display = 'none';
        });

        // Show session options associated with the selected event
        const selectedEventOptions = document.querySelectorAll('.sesi-acara-' + selectedEventId);
        selectedEventOptions.forEach(option => {
            option.style.display = 'block';
        });
    });
</script>


@endsection
