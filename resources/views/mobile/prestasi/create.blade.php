@extends('templates.mobile')

@section('body_class', 'sc5')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="single-page-area">
        <div class="title-area">
            <a class="btn back-page-btn" href="{{ route('mobile.prestasi.index') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3 class="ms-5 ps-5">Tambah Prestasi</h3>
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

                <form class="edit-form-wrap" method="POST" enctype="multipart/form-data" action="{{ route('mobile.prestasi.store') }}">
                    @csrf

                    <div class="col-md-6" style="display: none;">
                        <div class="single-input-wrap">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" placeholder="User ID" name="user_id"
                                id="user_id" value="{{ $user_id }}" readonly>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <select class="single-select w-100" name="tipe_prestasi">
                                <option selected disabled>Pilih Tipe Prestasi</option>
                                <option value="Keolahragaan" {{ old('tipe_prestasi') == 'Keolahragaan' ? 'selected' : '' }}>Keolahragaan</option>
                                <option value="Atlet" {{ old('tipe_prestasi') == 'Atlet' ? 'selected' : '' }}>Atlet</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="cabor_id">Cabang Olahraga</label>
                                <input type="text" class="form-control" list="cabor" id="cabor_id" placeholder="Isi Cabang Olahraga" name="cabor_id" value="{{ old('cabor_id') }}">
                                <datalist id="cabor">
                                    @foreach ($cabor as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama_cabor }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <p id="display_cabor" class="btn-c btn-sm btn-success mb-3"></p>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_event">Nama Event</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Event"
                                    id="nama_event" name="nama_event" value="{{ old('nama_event') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nama_team">Nama Team</label>
                                <input type="text" class="form-control" placeholder="Isi Nama Team"
                                    id="nama_team" name="nama_team" value="{{ old('nama_team') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="prestasi">Prestasi</label>
                                <input type="text" class="form-control" placeholder="Isi Prestasi"
                                    id="prestasi" name="prestasi" value="{{ old('prestasi') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="nomor_bukti_prestasi">Nomor Prestasi</label>
                                <input type="text" class="form-control" placeholder="Isi Nomor Prestasi"
                                    id="nomor_bukti_prestasi" name="nomor_bukti_prestasi" value="{{ old('nomor_bukti_prestasi') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" placeholder="Isi Tahun"
                                    id="tahun" name="tahun" value="{{ old('tahun') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="rekor">Rekor</label>
                                <input type="text" class="form-control" placeholder="Isi Rekor"
                                    id="rekor" name="rekor" value="{{ old('rekor') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="file_bukti_prestasi" class="form-label">Bukti Prestasi</label>
                                <input type="file" class="form-control" id="file_bukti_prestasi" name="file_bukti_prestasi"
                                    value="{{ old('file_bukti_prestasi') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan">{{ old('catatan') }}</textarea>
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
            function updateDisplayText(inputId, displayId) {
                var inputElement = document.getElementById(inputId);
                var selectedId = inputElement.value;
                var optionText = '';

                // Loop through options in the datalist to find the corresponding text
                var options = inputElement.list.options;
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value === selectedId) {
                        optionText = options[i].text;
                        break; // Exit the loop once the option is found
                    }
                }

                // Update the text in the display element
                var displayElement = document.getElementById(displayId);
                displayElement.textContent = optionText;
            }

            // Hide display text initially
            document.getElementById('display_cabor').style.display = 'none';

            // When the input gains focus (clicked)
            document.getElementById('cabor_id').addEventListener('focus', function() {
                document.getElementById('display_cabor').style.display = 'block';
            });

            // When an option is selected from the datalist
            document.getElementById('cabor_id').addEventListener('change', function() {
                updateDisplayText('cabor_id', 'display_cabor');
            });
        });
    </script>


@endsection
