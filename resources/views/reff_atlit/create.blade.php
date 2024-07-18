@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Baru
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('reff_atlit.store') }}">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Data User</label>
                <select id="testSelect" name="user_id">
                    <option value="">Pilih User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Create</button>
            <a href="{{ route('reff_atlit.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
        </form>
    </div>
</div>

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


@endsection
