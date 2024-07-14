@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Update Acara
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('acara.update', $acara->id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_acara" class="form-label">Nama Acara</label>
                        <input type="text" class="form-control @error('nama_acara') is-invalid @enderror" id="nama_acara"
                            name="nama_acara" value="{{ old('nama_acara', $acara->nama_acara) }}">
                        @error('nama_acara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi_acara" class="form-label">Lokasi Acara</label>
                        <input type="text" class="form-control @error('lokasi_acara') is-invalid @enderror"
                            id="lokasi_acara" name="lokasi_acara" value="{{ old('lokasi_acara', $acara->lokasi_acara) }}">
                        @error('lokasi_acara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal_awal_acara" class="form-label">Tanggal Awal Acara</label>
                        <input type="date" class="form-control @error('tanggal_awal_acara') is-invalid @enderror"
                            id="tanggal_awal_acara" name="tanggal_awal_acara"
                            value="{{ old('tanggal_awal_acara', $acara->tanggal_awal_acara) }}">
                        <span id="formatted_start_date"
                            class="badge bg-primary">{{ \Carbon\Carbon::parse($acara->tanggal_awal_acara)->format('d-m-Y') }}</span>
                        @error('tanggal_awal_acara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_akhir_acara" class="form-label">Tanggal Akhir Acara</label>
                        <input type="date" class="form-control @error('tanggal_akhir_acara') is-invalid @enderror"
                            id="tanggal_akhir_acara" name="tanggal_akhir_acara"
                            value="{{ old('tanggal_akhir_acara', $acara->tanggal_akhir_acara) }}">
                        <span id="formatted_end_date"
                            class="badge bg-primary">{{ \Carbon\Carbon::parse($acara->tanggal_akhir_acara)->format('d-m-Y') }}</span>
                        @error('tanggal_akhir_acara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status Acara</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="status_acara_active" name="status_acara" value="1" {{ $acara->status_acara == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_acara_active">Active</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="status_acara_inactive" name="status_acara" value="0" {{ $acara->status_acara == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_acara_inactive">Inactive</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_acara" class="form-label">Deskripsi Acara</label>
                    <textarea class="form-control @error('deskripsi_acara') is-invalid @enderror" id="deskripsi_acara"
                        name="deskripsi_acara">{{ old('deskripsi_acara', $acara->deskripsi_acara) }}</textarea>
                    @error('deskripsi_acara')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tingkat Wilayah Acara</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tingkat_kecamatan"
                                    name="tingkat_wilayah_acara" value="kecamatan"
                                    {{ old('tingkat_wilayah_acara', $acara->tingkat_wilayah_acara) == 'kecamatan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="tingkat_kecamatan">Kecamatan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tingkat_kota_kab"
                                    name="tingkat_wilayah_acara" value="kota"
                                    {{ old('tingkat_wilayah_acara', $acara->tingkat_wilayah_acara) == 'kota' ? 'checked' : '' }}>
                                <label class="form-check-label" for="tingkat_kota_kab">Kota/Kabupaten</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tingkat_provinsi"
                                    name="tingkat_wilayah_acara" value="provinsi"
                                    {{ old('tingkat_wilayah_acara', $acara->tingkat_wilayah_acara) == 'provinsi' ? 'checked' : '' }}>
                                <label class="form-check-label" for="tingkat_provinsi">Provinsi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tingkat_nasional"
                                    name="tingkat_wilayah_acara" value="nasional"
                                    {{ old('tingkat_wilayah_acara', $acara->tingkat_wilayah_acara) == 'nasional' ? 'checked' : '' }}>
                                <label class="form-check-label" for="tingkat_nasional">Nasional</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipe Acara</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tingkat_provinsi"
                                    name="tipe" value="1"
                                    {{ old('tipe', $acara->tipe) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="Pelatihan">Pelatihan/Workshop</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tingkat_provinsi"
                                    name="tipe" value="2"
                                    {{ old('tipe', $acara->tipe) == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="Kejuaraan">Kejuaraan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('acara.index') }}" class="btn btn-secondary">Cancel</a>
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

            // Initially display formatted start and end dates
            formattedStartDate.textContent = formatDate(startDateInput.value);
            formattedEndDate.textContent = formatDate(endDateInput.value);
        });
    </script>
@endsection
