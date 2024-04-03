@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.diklat.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Tambah Diklat</h3>
        </div>

        <div class="my-profile-detail">
            <div class="container">

                @if ($errors->any())
                    <div class="alert alert-primary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="edit-form-wrap" method="POST" enctype="multipart/form-data" action="{{ route('mobile.diklat.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="display:none;">
                            <div class="single-input-wrap">
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control" placeholder="User ID" name="user_id"
                                    id="user_id" value="{{ $user_id }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="tingkat">
                                <option selected disabled>Pilih Tingkat Diklat</option>
                                <option value="Lokal" {{ old('tingkat') == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                                <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_diklat">Nama Diklat</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Diklat"
                                    id="nama_diklat" name="nama_diklat" value="{{ old('nama_diklat') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tgl_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control" placeholder="Isi Tanggal Mulai"
                                    id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tgl_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control" placeholder="Isi Tanggal Selesai"
                                    id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="jumlah_jam">Jumlah Jam</label>
                                <input type="number" class="form-control" placeholder="Isi Jumlah Jam" id="jumlah_jam"
                                    name="jumlah_jam" value="{{ old('jumlah_jam') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="penyelenggara">Penyelenggara</label>
                                <input type="text" class="form-control" placeholder="Isi Penyelenggara"
                                    id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="foto_ijazah" class="form-label">Foto Ijazah/Sertifikat</label>
                                <input type="file" class="form-control" id="foto_ijazah" name="foto_ijazah"
                                    value="{{ old('foto_ijazah') }}">
                            </div>
                        </div>

                        <div class="col-md-6"> <!-- Ensure this div has the appropriate column size -->
                            <button class="btn-c btn-primary mb-2" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="main-footer-bottom d-block text-center">
            <ul>
                <li>
                    <a href="{{ route('mobile-landing') }}">
                        <img src="{{ asset('image/mobile/icon/svg/home.svg') }}" alt="icon">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('image/mobile/icon/svg/sports.svg') }}" alt="img">
                        Olahraga
                    </a>
                </li>
                <li>
                    <a class="menu-bar" href="{{ route('mobile.acara.index') }}">
                        <img src="{{ asset('image/mobile/icon/svg/ticket.svg') }}" alt="img">
                        Acara
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('image/mobile/icon/svg/document.svg') }}" alt="img">
                        Berita
                    </a>
                </li>
                <li>
                    <a class="active" href="{{ route('mobile-profil') }}">
                        <img src="{{ asset('image/mobile/icon/svg/profile.svg') }}" alt="img">
                        Profil
                    </a>
                </li>
            </ul>
        </div>

    </div>



    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

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
