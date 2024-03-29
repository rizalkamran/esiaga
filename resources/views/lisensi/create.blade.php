@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Buat Biodata
        </div>
        <div class="card-body">
            <form action="{{ route('lisensi.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="user_id" class="form-label">Nama</label>
                        <input class="form-control form-control-sm" list="datalistOptions1" id="user_id"
                            placeholder="Cari user" name="user_id" value="{{ old('user_id') }}">
                        <datalist id="datalistOptions1">
                            <datalist id="cabor">
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
                                @endforeach
                            </datalist>
                        </datalist>
                    </div>
                    <div class="col-md-3">
                        <label for="cabor_id" class="form-label">Cabang Olahraga</label>
                        <input class="form-control form-control-sm" list="datalistOptions2" id="cabor_id"
                            placeholder="Cari data Cabor" name="cabor_id" value="{{ old('cabor_id') }}">
                        <datalist id="datalistOptions2">
                            <datalist id="cabor">
                                @foreach ($cabor as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_cabor }}</option>
                                @endforeach
                            </datalist>
                        </datalist>
                    </div>
                    <div class="col-md-3">
                        <label for="tingkat" class="form-label">Tingkat</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="tingkat">
                            <option selected disabled>Pilih Tingkat</option>
                            <option value="Daerah" {{ old('tingkat') == 'Daerah' ? 'selected' : '' }}>Daerah</option>
                            <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="profesi" class="form-label">Profesi</label>
                        <input type="text" class="form-control form-control-sm" id="profesi" name="profesi"
                            value="{{ old('profesi') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_lisensi" class="form-label">Nama Lisensi</label>
                        <input type="text" class="form-control form-control-sm" id="nama_lisensi" name="nama_lisensi"
                            value="{{ old('nama_lisensi') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_lisensi" class="form-label">Nomor Lisensi</label>
                        <input type="text" class="form-control form-control-sm" id="nomor_lisensi" name="nomor_lisensi"
                            value="{{ old('nomor_lisensi') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control form-control-sm" id="penyelenggara" name="penyelenggara"
                            value="{{ old('penyelenggara') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tgl_mulai" class="form-label">Tanggal mulai Berlaku</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_mulai" name="tgl_mulai"
                            value="{{ old('tgl_mulai') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="tgl_selesai" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_selesai" name="tgl_selesai"
                            value="{{ old('tgl_selesai') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="foto_lisensi" class="form-label">Foto Lisensi</label>
                        <input type="file" class="form-control form-control-sm" id="foto_lisensi" name="foto_lisensi">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('lisensi.index') }}">Cancel</a>
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
