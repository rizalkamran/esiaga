@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Prestasi
        </div>
        <div class="card-body">
            <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <h6 class="form-label">Tipe Prestasi</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe_prestasi" id="tipe_prestasi1" value="Keolahragaan" {{ old('tipe_prestasi') == 'Keolahragaan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tipe_prestasi1">
                                Keolahragaan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe_prestasi" id="tipe_prestasi2" value="Atlet" {{ old('tipe_prestasi') == 'Atlet' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tipe_prestasi2">
                                Atlet
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if(request()->has('user_id'))
                            <!-- If there is a user_id parameter in the URL -->
                            <label for="user_id" class="form-label">Nama Lengkap</label>
                            <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}" readonly>
                            <input type="text" value="{{ $user->first()->nama_lengkap }}" class="form-control form-control-sm" disabled>
                        @else
                        <label for="user_id" class="form-label">Nama</label>
                        <select id="testSelect" name="user_id">
                            <option value="">Pilih User</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="cabor_id" class="form-label">Cabang Olahraga</label>
                        <select id="testSelect2" name="cabor_id">
                            <option value="">Pilih Cabor</option>
                            @foreach ($cabor as $c)
                                <option value="{{ $c->id }}" {{ old('cabor_id') == $c->id ? 'selected' : '' }}>{{ $c->nama_cabor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_event" class="form-label">Nama Event</label>
                        <input type="text" class="form-control form-control-sm" id="nama_event" name="nama_event"
                            value="{{ old('nama_event') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nama_team" class="form-label">Nama Team</label>
                        <input type="text" class="form-control form-control-sm" id="nama_team" name="nama_team"
                            value="{{ old('nama_team') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="prestasi" class="form-label">Prestasi</label>
                        <input type="text" class="form-control form-control-sm" id="prestasi" name="prestasi"
                            value="{{ old('prestasi') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control form-control-sm" id="tahun" name="tahun"
                            value="{{ old('tahun') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="rekor" class="form-label">Rekor</label>
                        <input type="text" class="form-control form-control-sm" id="rekor" name="rekor"
                            value="{{ old('rekor') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_bukti_prestasi" class="form-label">Nomor Prestasi</label>
                        <input type="text" class="form-control form-control-sm" id="nomor_bukti_prestasi" name="nomor_bukti_prestasi"
                            value="{{ old('nomor_bukti_prestasi') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="file_bukti_prestasi" class="form-label">Foto Sertifikat</label>
                        <input type="file" class="form-control form-control-sm" id="file_bukti_prestasi" name="file_bukti_prestasi">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('prestasi.index') }}">Cancel</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect("#testSelect2",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>

    @include('templates.footer')

@endsection
