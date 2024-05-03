@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Baru
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('acara.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_acara" class="form-label">Nama Acara</label>
                        <input type="text" class="form-control @error('nama_acara') is-invalid @enderror" id="nama_acara" name="nama_acara" value="{{ old('nama_acara') }}">
                        @error('nama_acara')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi_acara" class="form-label">Lokasi Acara</label>
                        <input type="text" class="form-control @error('lokasi_acara') is-invalid @enderror" id="lokasi_acara" name="lokasi_acara" value="{{ old('lokasi_acara') }}">
                        @error('lokasi_acara')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_awal_acara" class="form-label">Tanggal Awal Acara</label>
                        <input type="date" class="form-control @error('tanggal_awal_acara') is-invalid @enderror" id="tanggal_awal_acara" name="tanggal_awal_acara" value="{{ old('tanggal_awal_acara') }}">
                        <span id="formatted_start_date" class="badge bg-primary"></span>
                        @error('tanggal_awal_acara')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir_acara" class="form-label">Tanggal Akhir Acara</label>
                        <input type="date" class="form-control @error('tanggal_akhir_acara') is-invalid @enderror" id="tanggal_akhir_acara" name="tanggal_akhir_acara" value="{{ old('tanggal_akhir_acara') }}">
                        <span id="formatted_end_date" class="badge bg-primary"></span>
                        @error('tanggal_akhir_acara')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_acara" class="form-label">Deskripsi Acara</label>
                    <textarea class="form-control @error('deskripsi_acara') is-invalid @enderror" id="deskripsi_acara" name="deskripsi_acara">{{ old('deskripsi_acara') }}</textarea>
                    @error('deskripsi_acara')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Tingkat Wilayah Acara</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="tingkat_kecamatan" name="tingkat_wilayah_acara" value="kecamatan" @if(old('tingkat_wilayah_acara') == 'kecamatan') checked @endif>
                            <label class="form-check-label" for="tingkat_kecamatan">Kecamatan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="tingkat_kota_kab" name="tingkat_wilayah_acara" value="kota" @if(old('tingkat_wilayah_acara') == 'kota') checked @endif>
                            <label class="form-check-label" for="tingkat_kota_kab">Kota/Kabupaten</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="tingkat_provinsi" name="tingkat_wilayah_acara" value="provinsi" @if(old('tingkat_wilayah_acara') == 'provinsi') checked @endif>
                            <label class="form-check-label" for="tingkat_provinsi">Provinsi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="tingkat_nasional" name="tingkat_wilayah_acara" value="nasional" @if(old('tingkat_wilayah_acara') == 'nasional') checked @endif>
                            <label class="form-check-label" for="tingkat_nasional">Nasional</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Create</button>
                <a href="{{ route('acara.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the input fields
            var startDateInput = document.getElementById('tanggal_awal_acara');
            var endDateInput = document.getElementById('tanggal_akhir_acara');
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
