@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Data Pekerjaan
        </div>
        <div class="card-body">
            <form action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-md-3">
                        @if(request()->has('user_id'))
                            <!-- If there is a user_id parameter in the URL -->
                            <label for="user_id" class="form-label">Nama Lengkap</label>
                            <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}" readonly>
                            <input type="text" value="{{ $user->first()->nama_lengkap }}" class="form-control form-control-sm" disabled>
                        @else
                        <label for="user_id" class="form-label">Nama</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="user_id">
                            <option selected disabled>Pilih user</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label for="tipe_kerja" class="form-label">Tipe Kerja</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="tipe_kerja">
                            <option selected disabled>Pilih Tingkat</option>
                            <option value="Kontrak" {{ old('tipe_kerja') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                            <option value="Pegawai Tetap" {{ old('tipe_kerja') == 'Pegawai Tetap' ? 'selected' : '' }}>Pegawai Tetap</option>
                            <option value="Magang" {{ old('tipe_kerja') == 'Magang' ? 'selected' : '' }}>Magang</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control form-control-sm" id="pekerjaan" name="pekerjaan"
                            value="{{ old('pekerjaan') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan"
                            value="{{ old('jabatan') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                        <input type="text" class="form-control form-control-sm" id="nama_instansi" name="nama_instansi"
                            value="{{ old('nama_instansi') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                        <input type="text" class="form-control form-control-sm" id="alamat_instansi" name="alamat_instansi"
                            value="{{ old('alamat_instansi') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="kontak_instansi" class="form-label">Kontak Instansi</label>
                        <input type="text" class="form-control form-control-sm" id="kontak_instansi" name="kontak_instansi"
                            value="{{ old('kontak_instansi') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="tgl_mulai" class="form-label">Tanggal mulai Berlaku</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_mulai" name="tgl_mulai"
                            value="{{ old('tgl_mulai') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tgl_selesai" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_selesai" name="tgl_selesai"
                            value="{{ old('tgl_selesai') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="bukti_kerja" class="form-label">Bukti Kerja</label>
                        <input type="file" class="form-control form-control-sm" id="bukti_kerja" name="bukti_kerja">
                    </div>
                    <div class="col-md-3">
                        <h6>Status Pekerjaan</h6>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="status_kerja" name="status_kerja" value="1">
                            <label class="form-check-label" for="status_kerja">Klik jika bekerja sampai saat ini</label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('pekerjaan.index') }}">Cancel</a>
            </form>
        </div>
    </div>

    @include('templates.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the input fields
            var startDateInput = document.getElementById('tgl_mulai');
            var endDateInput = document.getElementById('tgl_selesai');
            var formattedStartDate = document.getElementById('formatted_start_date');
            var formattedEndDate = document.getElementById('formatted_end_date');

            // Function to format date as 'dd-mm-yyyy'
            function formatDate(dateString) {
                var date = new Date(dateString);
                var day = String(date.getDate()).padStart(2, '0');
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var year = date.getFullYear();
                return day + '-' + month + '-' + year;
            }

            // Add change event listener to the start date input field
            startDateInput.addEventListener('change', function() {
                // Set the minimum value of the end date input field to the selected value of the start date input field
                endDateInput.min = startDateInput.value;
                formattedStartDate.textContent = formatDate(startDateInput.value);
            });

            // Add change event listener to the end date input field
            endDateInput.addEventListener('change', function() {
                formattedEndDate.textContent = formatDate(endDateInput.value);
            });
        });
    </script>

@endsection
