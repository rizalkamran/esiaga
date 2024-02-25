<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="author" content="SemiColonWeb">
	<meta name="description" content="Create Football Club Websites with Canvas Template. Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">

	<!-- Font Imports -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">

	<!-- Core Style -->
	<link rel="stylesheet" href="{{ asset('css/web/style.css') }}">

	<!-- Font Icons -->
	<link rel="stylesheet" href="{{ asset('css/web/font-icons.css') }}">

	<!-- Niche Demos -->
	<link rel="stylesheet" href="{{ asset('demos/football-club/football-club.css') }}">

	<link rel="shortcut icon" href="{{ asset('image/web/icon_esiaga_2.png') }}" type="image/png">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('css/web/custom.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Document Title
	============================================= -->
	<title>Register or Login | e-Siaga</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper">

		<!-- Header
		============================================= -->
		@include('templates.header')

		<!-- Page Title
		============================================= -->
		<!--
		<section class="page-title bg-transparent">
			<div class="container">
				<div class="page-title-row">

					<div class="page-title-content">
						<h1>Registrasi || Login</h1>
					</div>

					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
							<li class="breadcrumb-item active" aria-current="page">Login</li>
						</ol>
					</nav>

				</div>
			</div>
		</section>
		-->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

					<div class="row g-5">
						<div class="col-md-4">
							<div class="card mb-0 p-2 border-default bg-contrast-100">
								<div class="card-body p-4">

									<form class="row mb-0" method="POST" action="{{ route('login') }}">
                                        @csrf

										<div class="col-12">
											<h3>Form Login</h3>
										</div>

										<div class="col-12 form-group">
											<label for="name">Username:</label>
											<input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
										</div>

										<div class="col-12 form-group">
											<label for="password">Kata Sandi:</label>
											<input type="password" id="password" name="password" value="" class="form-control">
										</div>

										<div class="col-12 form-group">
											<div class="d-flex justify-content-between">
												<button class="btn btn-secondary m-0" type="submit">Masuk</button>
												<a href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
											</div>
										</div>
									</form>

								</div>
							</div>

						</div>

						<div class="col-md-8">

							<h3 class="mb-3">Form Registrasi</h3>

							<p class="pb-2">Aplikasi ini dibuat sebagai portal informasi online bagi semua pihak terkait tentang jadwal pelatihan serta event kejuaraan tingkat Nasional/Internasional yang diselenggarakan di wilayah Kaltim. </p>
							<!--<p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, vel odio non dicta provident sint ex autem mollitia dolorem illum repellat ipsum aliquid illo similique sapiente fugiat minus ratione.</p>-->

							<form class="row" method="POST" action="{{ route('desktop.user.store') }}">
                                @csrf

								<div class="col-6 form-group">
									<label for="nama_lengkap">Nama Lengkap:</label>
									<input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control">
								</div>

								<div class="col-6 form-group">
									<label for="nomor_ktp">NIK / Nomor KTP:</label>
									<input type="number" id="nomor_ktp" name="nomor_ktp" value="{{ old('nomor_ktp') }}" class="form-control">
								</div>

								<div class="col-6 form-group">
									<label for="telepon">Nomor HP / Whatsapp:</label>
									<input type="number" id="telepon" name="telepon" value="{{ old('telepon') }}" class="form-control">
								</div>

								<div class="col-6 form-group">
									<label for=email">Email:</label>
									<input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
								</div>

								<div class="fancy-title title-border title-center"></div>

								<div class="col-6 form-group">
                                    <label for="role_select">Role:</label>
                                    <select class="form-control" id="role_select" name="roles[]">
                                        <option>-- Pilih --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                    @isset($user)
                                                        @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif
                                                    @endisset>
                                                @if ($role->name === 'publik')
                                                    Umum
                                                @elseif ($role->name === 'non-publik')
                                                    Atlit/Pelatih/Guru
                                                @else
                                                    {{ $role->name }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>




								<div class="col-6 form-group">
									<label for="name">Buat Username:</label>
									<input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
								</div>

								<div class="w-100"></div>

								<div class="col-6 form-group">
									<label for="password">Buat Kata Sandi:</label>
									<input type="password" id="password" name="password" value="" class="form-control">
								</div>

								<div class="col-6 form-group">
									<label for="password_confirmation">Ulangi Kata Sandi:</label>
									<input type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control">
								</div>

                                <div class="col-6 form-group">
                                    <h5>Jenis Kelamin</h5>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L">
                                        <label class="form-check-label" for="laki-laki">Pria</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P">
                                        <label class="form-check-label" for="perempuan">Wanita</label>
                                    </div>
                                </div>


								<div class="w-100"></div>

								<div class="col-12 form-group">
									<button class="btn btn-dark m-0" type="submit">Daftar</button>
								</div>

							</form>

						</div>
					</div>

				</div>
			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		@include('templates.footer2')

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="uil uil-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{ asset('js/web/plugins.min.js') }}"></script>
	<script src="{{ asset('js/web/functions.bundle.js') }}"></script>

</body>
</html>
