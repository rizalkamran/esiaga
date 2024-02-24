<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Siaga 0.1') }}</title>


    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css"
     integrity="sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!--fivicon icon-->
    <link href="{{ asset('image/mobile/favicon-esiaga.png') }}" rel="icon" type="image/png">

</head>

<body>
    <div>


        <nav class="navbar navbar-expand-lg">
            <div class="container-md">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'E-Siaga 0.1') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @can('is-admin')
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Data Master
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Data User</a></li>
                                  <li><a class="dropdown-item" href="#">Role</a></li>
                                </ul>
                            </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Referensi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item" href="{{ route('cabor.index') }}">Data Cabang Olahraga</a></li>
                              <li><a class="dropdown-item" href="{{ route('peran.index') }}">Data Peran</a></li>
                              <li><a class="dropdown-item" href="{{ route('data-provinsi.index') }}">Data Provinsi</a></li>
                              <li><a class="dropdown-item" href="{{ route('data-kota.index') }}">Data Kota</a></li>
                            </ul>
                        </li>
                        @endcan

                        @can('logged-in')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Anggota
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('biodata.index') }}">Biodata</a></li>
                                <li><a class="dropdown-item" href="{{ route('diklat.index') }}">Diklat</a></li>
                            </ul>
                        </li>
                        @endcan

                        @can('logged-in')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Acara
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('acara.index') }}">Daftar Acara</a></li>
                                <li><a class="dropdown-item" href="{{ route('kode-acara.index') }}">Data Kode Acara</a></li>
                                <li><a class="dropdown-item" href="{{ route('registrasi.index') }}">Data Registrasi Peserta</a></li>
                                <li><a class="dropdown-item" href="{{ route('kehadiran.index') }}">Data Kehadiran Peserta</a></li>
                            </ul>
                        </li>
                        @endcan

                        @can('is-publik')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Anggota
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('publik.anggota_peran.index') }}">Data Peran Anggota</a></li>
                            </ul>
                        </li>
                        @endcan


                    </ul>
                </div>

                    <div class="d-flex" role="search">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>

                                    <form method="POST" id="logout-form" action="{{ route('logout') }}" style="display: none">
                                        @csrf
                                    </form>
                                @else
                                    {{-- <a href="{{ route('login') }}">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif --}}
                                @endauth
                            </div>
                        @endif
                    </div>
            </div>
        </nav>

        <main class="container-md">
            @include('partials.alerts')
            @yield('content')
        </main>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

        <script src="https://kit.fontawesome.com/6bee2f06a8.js" crossorigin="anonymous"></script>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.selectcustom').selectpicker();
            });

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </div>

</body>

</html>
