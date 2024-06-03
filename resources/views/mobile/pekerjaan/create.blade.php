@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.pekerjaan.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Tambah Pekerjaan</h3>
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

                <form class="edit-form-wrap" method="POST" enctype="multipart/form-data" action="{{ route('mobile.pekerjaan.store') }}">
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
                            <select class="single-select w-100" name="tipe_kerja">
                                <option selected disabled>Pilih Tipe Kerja</option>
                                <option value="Kontrak" {{ old('tipe_kerja') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                <option value="Pegawai Tetap" {{ old('tipe_kerja') == 'Pegawai Tetap' ? 'selected' : '' }}>Pegawai Tetap</option>
                                <option value="Magang" {{ old('tipe_kerja') == 'Magang' ? 'selected' : '' }}>Magang</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" placeholder="Isi Pekerjaan"
                                    id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" placeholder="Isi Jabatan"
                                    id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_instansi">Nama Instansi</label>
                                <input type="text" class="form-control" placeholder="Nama Instansi"
                                    id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="alamat_instansi">Alamat Instansi</label>
                                <input type="text" class="form-control" placeholder="Alamat Instansi"
                                    id="alamat_instansi" name="alamat_instansi" value="{{ old('alamat_instansi') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="kontak_instansi">Kontak Instansi</label>
                                <input type="text" class="form-control" placeholder="Kontak Instansi"
                                    id="kontak_instansi" name="kontak_instansi" value="{{ old('kontak_instansi') }}">
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
                                <label for="bukti_kerja" class="form-label">Bukti Kerja</label>
                                <input type="file" class="form-control" id="bukti_kerja" name="bukti_kerja"
                                    value="{{ old('bukti_kerja') }}">
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
