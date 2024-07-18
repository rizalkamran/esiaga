@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Edit Data Atlit
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

        <form method="POST" action="{{ route('daftar_atlit.update', $daftaratlit) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <!-- Event dropdown/select -->
                    <label for="acara_id" class="form-label">Pilih Acara</label>
                    <select name="acara_id" class="form-control" id="acara_id">
                        <option value="">Pilih Acara</option>
                        @foreach($acara as $ac)
                            <option value="{{ $ac->id }}" {{ $daftaratlit->kategori->acara_id == $ac->id ? 'selected' : '' }}>
                                {{ $ac->nama_acara }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <!-- Session dropdown/select -->
                    <label for="kategori_id" class="form-label">Pilih Kategori</label>
                    <select name="kategori_id" class="form-control" id="kategori_id">
                        <option value="">Pilih Kategori</option>
                        <!-- Populate all session options -->
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" class="kategori-option kategori-{{ $k->acara_id }}" {{ $daftaratlit->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="user_id" class="form-label">Pilih Peserta/Atlit</label>
                    <select id="testSelect" name="user_id">
                        <option value="">Peserta/Atlit</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $daftaratlit->user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('daftar_atlit.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect("#testSelect",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventSelect = document.getElementById('acara_id');
        const sessionOptions = document.querySelectorAll('.kategori-option');

        eventSelect.addEventListener('change', function(event) {
            const selectedEventId = event.target.value;

            // Hide all session options initially
            sessionOptions.forEach(option => {
                option.style.display = 'none';
            });

            // Show session options associated with the selected event
            if (selectedEventId) {
                const selectedEventOptions = document.querySelectorAll('.kategori-' + selectedEventId);
                selectedEventOptions.forEach(option => {
                    option.style.display = 'block';
                });
            }
        });

        // Trigger change event to apply the filter on page load (if needed)
        eventSelect.dispatchEvent(new Event('change'));
    });
</script>
