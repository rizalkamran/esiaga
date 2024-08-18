@extends('templates.main')

@section('content')

<div class="card shadow mt-3">
    <div class="card-header">
        Registrasi Peserta - Kejuaraan
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

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('registrasi2.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Data User</label>
                    <select id="testSelect" name="user_id">
                        <option value="">Pilih User</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="peran_id" class="form-label">Data Peran</label>
                    <select class="form-select" name="peran_id">
                        <option value="">Pilih Peran</option>
                        @foreach ($peran as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_peran }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <!-- Event dropdown/select -->
                    <label for="acara_id" class="form-label">Pilih Kejuaraan</label>
                    <select class="form-select" name="acara_id">
                        <option value="">Pilih Kejuaraan</option>
                        @foreach($acara as $ac)
                            <option value="{{ $ac->id }}">{{ Illuminate\Support\Str::limit($ac->nama_acara, 40)  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm mt-3">Create</button>
            <a href="{{ route('registrasi2.index', request()->query()) }}" class="btn btn-secondary btn-sm mt-3">Cancel</a>
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
