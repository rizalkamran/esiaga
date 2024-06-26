@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Update data diklat
        </div>
        <div class="card-body">
            <form action="{{ route('diklat.update', $diklat) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="nama_diklat" class="form-label">Nama Lisensi</label>
                        <input type="text" class="form-control form-control-sm" id="nama_diklat" name="nama_diklat"
                            value="{{ $diklat->nama_diklat }}">
                    </div>
                    <div class="col-md-4">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control form-control-sm" id="penyelenggara" name="penyelenggara"
                            value="{{ $diklat->penyelenggara }}">
                    </div>
                    <div class="col-md-4">
                        <label for="tingkat" class="form-label">Tingkat</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="tingkat">
                            <option selected disabled>Pilih Tingkat</option>
                            <option value="Lokal" {{ $diklat->tingkat == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                            <option value="Provinsi" {{ $diklat->tingkat == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                            <option value="Nasional" {{ $diklat->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="Internasional" {{ $diklat->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="tgl_mulai" class="form-label">Tanggal mulai Berlaku</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_mulai" name="tgl_mulai"
                            value="{{ $diklat->tgl_mulai }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tgl_selesai" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_selesai" name="tgl_selesai"
                            value="{{ $diklat->tgl_selesai }}">
                    </div>
                    <div class="col-md-3">
                        <label for="jumlah_jam" class="form-label">Jumlah Jam</label>
                        <input type="number" class="form-control form-control-sm" id="jumlah_jam" name="jumlah_jam"
                            value="{{ $diklat->jumlah_jam }}">
                    </div>
                    <div class="col-md-3">
                        <label for="foto_ijazah" class="form-label">Foto Lisensi</label>
                        <input type="file" class="form-control form-control-sm" id="foto_ijazah" name="foto_ijazah">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('diklat.index') }}">Cancel</a>
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
