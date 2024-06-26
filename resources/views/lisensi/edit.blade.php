@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Update data Sertifikat
        </div>
        <div class="card-body">
            <form action="{{ route('lisensi.update', $lisensi) }}" method="POST" enctype="multipart/form-data">
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="cabor_id" class="form-label">Cabang Olahraga</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="cabor_id">
                            <option selected disabled>Pilih Cabor</option>
                            @foreach ($cabor as $c)
                                <option value="{{ $c->id }}" {{ $lisensi->cabor_id == $c->id ? 'selected' : '' }}>{{ $c->nama_cabor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tingkat" class="form-label">Tingkat</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="tingkat">
                            <option selected disabled>Pilih Tingkat</option>
                            <option value="Daerah" {{ $lisensi->tingkat == 'Daerah' ? 'selected' : '' }}>Daerah</option>
                            <option value="Nasional" {{ $lisensi->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="Internasional" {{ $lisensi->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="profesi" class="form-label">Profesi</label>
                        <input type="text" class="form-control form-control-sm" id="profesi" name="profesi"
                            value="{{ $lisensi->profesi }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_lisensi" class="form-label">Nama Lisensi</label>
                        <input type="text" class="form-control form-control-sm" id="nama_lisensi" name="nama_lisensi"
                            value="{{ $lisensi->nama_lisensi }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_lisensi" class="form-label">Nomor Lisensi</label>
                        <input type="text" class="form-control form-control-sm" id="nomor_lisensi" name="nomor_lisensi"
                            value="{{ $lisensi->nomor_lisensi }}">
                    </div>
                    <div class="col-md-4">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control form-control-sm" id="penyelenggara" name="penyelenggara"
                            value="{{ $lisensi->penyelenggara }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tgl_mulai" class="form-label">Tanggal mulai Berlaku</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_mulai" name="tgl_mulai"
                            value="{{ $lisensi->tgl_mulai }}">
                    </div>
                    <div class="col-md-4">
                        <label for="tgl_selesai" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_selesai" name="tgl_selesai"
                            value="{{ $lisensi->tgl_selesai }}">
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
