@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Update data pendidikan
        </div>
        <div class="card-body">
            <form action="{{ route('pendidikan.update', $pendidikan) }}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-md-3">
                        <label for="tingkat" class="form-label">Tingkat Pendidikan</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="pendidikan_id">
                            <option selected disabled>Pilih Tingkat</option>
                            @foreach ($reff as $r)
                            <option value="{{ $r->id }}" {{ $pendidikan->pendidikan_id == $r->id ? 'selected' : '' }}>{{ $r->nama_pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="gelar_depan" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control form-control-sm" id="gelar_depan" name="gelar_depan"
                            value="{{ $pendidikan->gelar_depan }}">
                    </div>
                    <div class="col-md-3">
                        <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                        <input type="text" class="form-control form-control-sm" id="gelar_belakang" name="gelar_belakang"
                            value="{{ $pendidikan->gelar_belakang }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control form-control-sm" id="tahun_lulus" name="tahun_lulus"
                            value="{{ $pendidikan->tahun_lulus }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control form-control-sm" id="nama_sekolah" name="nama_sekolah"
                            value="{{ $pendidikan->nama_sekolah }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nama_jurusan" class="form-label">Program Studi/Jurusan</label>
                        <input type="text" class="form-control form-control-sm" id="nama_jurusan" name="nama_jurusan"
                            value="{{ $pendidikan->nama_jurusan }}">
                    </div>
                    <div class="col-md-4">
                        <label for="ijazah" class="form-label">Foto Ijazah</label>
                        <input type="file" class="form-control form-control-sm" id="ijazah" name="ijazah">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a class="btn btn-sm btn-secondary" href="{{ route('pendidikan.index') }}">Cancel</a>
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
