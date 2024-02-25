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
	<title>Beranda | e-Siaga</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper">

		<!-- Header
		============================================= -->
        @include('templates.header')


		<!-- Hero
		============================================= -->
		<section id="slider" class="slider-element dark include-header" style="background: linear-gradient(transparent 70%, rgba(0,0,0,.1)), url('demos/football-club/images/hero-bg.jpg') no-repeat center center / cover;">
        <section id="slider" class="slider-element dark include-header" style="background: linear-gradient(transparent 70%, rgba(0,0,0,.1)), url('{{ asset('demos/football-club/images/hero-bg.jpg') }}') no-repeat center center / cover;">


			<div class="container">
				<div class="row align-items-center justify-content-center min-vh-75 min-vh-lg-100">
					<div class="col-lg-6 py-4" style="">
						<h6 class="mb-4 ls-1 text-uppercase ls-2 fw-normal bg-light bg-opacity-10 d-inline-block py-2 px-3 rounded-pill">Dinas Pemuda Dan Olahraga Prov Kaltim</h6>
						<h1 class="display-2 fw-800 text-uppercase ls-n-1"><span style="font-size:40px">Aplikasi </span>  <div style="font-size:40px">Peningkatan Prestasi Olahraga</div></h1>
						<p class="lead" style="font-size:16px">Sebuah aplikasi yang diharapkan mampu memonitor berbagai aspek dalam peningkatan prestasi olahraga para atlet wilayah Kalimantan Timur seperti aspek latihan fisik dan manajemen waktu.</p>
						<a href="{{ route('desktop.register') }}" target="_blank" class="button button-large h-bg-color button-light button-white py-3 px-3 text-uppercase ls-1 fw-medium transform-skew"><span>Daftar / Login</span></a>
					</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="col-lg-5 d-none d-lg-block" style="margin-right:-100px">
						<!--<img src="demos/football-club/images/player-with-ball.png" alt="Hero Bg" style="margin-top: 100px;">-->
						<img src="{{ asset('demos/football-club/images/sport_day_2.png') }}" alt="Hero Bg" style="margin-top:0px; height:500px">
					</div>
				</div>
			</div>

			<!-- <div class="shape-divider" data-shape="wave" data-position="bottom" data-height="80"></div> -->

		</section>

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pt-0">

				<!-- 1. News Ticker Section
				============================================= -->
				<div class="py-4 bg-color dark">
					<div class="container overflow-hidden">
						<div class="row align-items-center gy-3">
							<div class="col-md-auto">
								<h3 class="mb-0 text-uppercase ls-1">Jurnal Olahraga</h3>
							</div>

							<div class="col-md-9 border-start border-light">
								<div class="ticker-wrap pause-on-hover">
									<div class="ticker">
										<a href="#" class="ticker-item btn-link text-light">Konsultan Teknik KONI Kaltim Siap Kawal Performa Atlet demi Lima Besar</a>
										<a href="#" class="ticker-item btn-link text-light">Pelatih Rasakan Manfaat Coaching Clinic KONI Kaltim</a>
										<a href="#" class="ticker-item btn-link text-light">Oranyekan Batakan, Borneo FC Beri Pujian Untuk Pusamania</a>
										<a href="#" class="ticker-item btn-link text-light">Woodball Kaltim Optimistis Tunggal Putri Raih Emas pada PON Aceh - Sumut</a>
										<a href="#" class="ticker-item btn-link text-light">Borneo FC Nyaman Bersama Pieter Huistra</a>
										<a href="#" class="ticker-item btn-link text-light">Bola Tangan Kaltim Bentuk Tim Ideal Lewat Promosi dan Degradasi</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


					<!-- Charts Area
					============================================= -->
					<!--
					<div class="mb-5 mx-auto" style="max-width: 750px; min-height: 350px" >
						<canvas id="chart-0"></canvas>
					</div>

					<div class="toolbar text-center" style="">
						<button class="btn btn-secondary btn-sm" id="randomizeData">Randomize Data</button>
						<button class="btn btn-secondary btn-sm" id="addDataset">Add Dataset</button>
						<button class="btn btn-secondary btn-sm" id="removeDataset">Remove Dataset</button>
						<button class="btn btn-secondary btn-sm" id="addData">Add Data</button>
						<button class="btn btn-secondary btn-sm" id="removeData">Remove Data</button>
					</div>
					-->
					<!-- Charts Area End -->

					<div class="line" style="display:none"></div>

				<!-- 2. About Section
				============================================= -->
				<div class="section my-0" style="">
					<div class="container mb-3">
						<div class="row align-items-center gx-4 gy-5">

							<div class="mb-5 mx-auto" style="max-width: 1050px; min-height: 350px" >
								<canvas id="chart-0"></canvas>
							</div>

							<!--
							<div class="toolbar text-center" style="">
								<button class="btn btn-secondary btn-sm" id="randomizeData">Randomize Data</button>
								<button class="btn btn-secondary btn-sm" id="addDataset">Add Dataset</button>
								<button class="btn btn-secondary btn-sm" id="removeDataset">Remove Dataset</button>
								<button class="btn btn-secondary btn-sm" id="addData">Add Data</button>
								<button class="btn btn-secondary btn-sm" id="removeData">Remove Data</button>
							</div>
							-->

							<!--
							<div class="col-lg-5">
								<img src="demos/football-club/images/player.png" alt="..">
							</div>
							<div class="col-lg-1"></div>
							<div class="col-lg-6">
								<h6 class="mb-4 ls-1 text-uppercase ls-2 fw-normal bg-dark bg-opacity-10 d-inline-block py-2 px-3 rounded-pill">About Us</h6>
								<h1 class="display-3 fw-800 text-uppercase ls-n-1">Welcome to the <br>club of Canvas FC</h1>
								<p class="lead mb-5">Rapidiously conceptualize inexpensive value through functionalized markets web services end-to-end products.</p>
								<a href="#" class="button button-large h-bg-color button-dark button-black text-uppercase ls-1 fw-medium transform-skew"><span>Learn More<i class="bi-arrow-right ms-2 me-0"></i></span></a>
							</div>
							-->
						</div>
					</div>
				</div>

				<!-- 3. Large Schedule Section
				============================================= -->
                <div class="section dark my-0" style="background: url('{{ asset('demos/football-club/images/section-bg.jpg') }}') no-repeat center bottom / cover;">
					<div class="row align-items-center justify-content-between g-5">
						<div class="col-12 text-center">
							<h3 class="fs-2 text-decoration-underline text-underline-offset-5 text-uppercase fw-800 mb-3">Event Berikutnya</h3>
							<select name="" class="mb-0 ls-1 text-uppercase ls-2 fw-normal bg-color text-light d-inline-block py-2 px-3 rounded">
								<option value="">-- Pilih --</option>
								<option value="we">Pertandingan Sepak Bola</option>
								<option value="rt" selected>Pelatihan LTAD (27 Feb s/d 01 Maret 2024)</option>
							</select>
						</div>

						<div class="col-md-3">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="{{ asset('demos/football-club/images/logo/logo_guru_olahraga.png') }}" alt=".." width="170" style="margin-top:-30px; margin-bottom:-30px">
								<h5 class="text-uppercase fw-800 mb-0 mt-3" style="margin-top:-100">Perhimpunan Guru Olahraga</h5>
								<h5 class="fw-medium text-uppercase ls-1">Kalimantan Timur</h5>
							</div>
						</div>
						<div class="col-md-6">
							<div id="countdown-ex1" class="countdown counter-large" data-year="2024" data-month="2" data-day="27" data-hour="9" data-format="ydHMS"></div>
						</div>
						<div class="col-md-3">
							<div class="d-flex flex-column align-items-center text-center justify-content-end">
								<img src="{{ asset('demos/football-club/images/logo/logo_dispora_4.png') }}" alt=".." width="150">
								<h5 class="text-uppercase fw-800 mb-0 mt-3">DISPORA PROVINSI</h5>
								<h5 class="fw-medium text-uppercase ls-1">Kalimantan Timur</h5>
							</div>
						</div>

						<div class="col-12 text-center">
							<a href="#" class="button button-large button-border button-light button-white"><i class="fa-solid fa-circle-info me-2"></i> Detail</a>
							<a href="#" class="button button-large button-light button-white h-bg-color"><i class="fa-solid fa-ticket me-2"></i> Registrasi</a>
						</div>
					</div>
				</div>

				<!-- Grid Schedule Section
				============================================= -->
				<div class="section my-0 bg-transparent">
					<div class="container">
						<div class="row gx-4 gy-5">
							<div class="col-md-6">
								<h3 class="mb-3 fw-semibold"><u>Event Selanjutnya</u></h3>
								<div class="card rounded-0 bg-amazon border-0 dark">
									<div class="card-body p-5">
										<div class="row align-items-center">
											<div class="col-md-3">
												<div class="d-flex flex-column align-items-center text-center">
													<img src="{{ asset('demos/football-club/images/logo/logo_woodball.png') }}" alt=".." width="70">
													<h4 class="text-uppercase fw-800 mb-0 mt-2">Pengprov</h4>
													<h6 class="fw-medium text-uppercase ls-1">Woodball</h6>
												</div>
											</div>
											<div class="col-md-6 text-center">
												<h4 class="mb-0 border border-width-2 p-2 border-light border-opacity-10">02/04/2024 - 09:00</h4>
												<p class="text-uppercase small mb-0 mt-2 ls-1" style="font-size:10px">Pelatihan Pelatih <br>Hotel Grand Senyiur Balikpapan</p>
											</div>
											<div class="col-md-3">
												<div class="d-flex flex-column align-items-center text-center justify-content-end">
													<img src="{{ asset('demos/football-club/images/logo/logo_dispora_4.png') }}" alt=".." width="200" style="margin-top:10px; margin-bottom:5px">
													<h4 class="text-uppercase fw-800 mb-0 mt-2" style="">Dispora</h4>
													<h6 class="fw-medium text-uppercase ls-1">Prov Kaltim</h6>
												</div>
											</div>
										</div>
									</div>
									<a href="#" class="button button-large button-dark button-black m-0 card-footer text-uppercase py-3">Event Info <i class="fa-solid fa-angles-right me-2"></i></a>
								</div>
							</div>

							<div class="col-md-6">
								<h3 class="mb-3 fw-semibold"><u>Event Sebelumnya</u></h3>
								<div class="card rounded-0 bg-blogger border-0 dark">
									<div class="card-body p-5">
										<div class="row align-items-center">
											<div class="col-md-4">
												<div class="d-flex flex-column align-items-center text-center">
													<img src="{{ asset('demos/football-club/images/logo/1.png') }}" alt=".." width="70">
													<h4 class="text-uppercase fw-800 mb-0 mt-2">Canvas FC</h4>
													<h6 class="fw-medium text-uppercase ls-1">Samarinda Club</h6>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<h3 class="mb-0 border border-width-2 p-2 border-light border-opacity-10">3 - 1</h3>
												<h5 class="text-uppercase small mb-0 mt-2">05/01/2024</h5>
												<p class="text-uppercase small mb-0 mt-2 ls-1" style="font-size:10px">Kejuaraan Terbuka Tenis Meja</p>
											</div>
											<div class="col-md-4">
												<div class="d-flex flex-column align-items-center text-center justify-content-end">
													<img src="demos/football-club/images/logo/2.svg" alt=".." width="70">
													<h4 class="text-uppercase fw-800 mb-0 mt-2">Royal XI FC</h4>
													<h6 class="fw-medium text-uppercase ls-1">Kukar Club</h6>
												</div>
											</div>
										</div>
									</div>
									<a href="#" class="button button-large button-dark button-black m-0 card-footer text-uppercase py-3">Event Info <i class="fa-solid fa-angles-right me-2"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Latest News Grid Section
				============================================= -->
				<div class="section bg-contrast-200 my-0">
					<div class="container">
						<div class="text-center mb-5">
							<h3 class="fs-2 text-decoration-underline text-underline-offset-5 text-uppercase fw-800 mb-3">Berita Terbaru</h3>
						</div>

						<div class="row align-items-stretch flex-lg-row-reverse g-4">
							<div class="col-lg-6">
								<div class="card border-0 overflow-hidden h-100">
									<img src="{{ asset('demos/football-club/images/koni_kaltim.png') }}" class="object-fit-cover w-100 h-100" alt="...">
									<div class="card-body">
										<h4 class="card-title font-body mb-3">Konsultan Teknik KONI Kaltim Siap Kawal Performa Atlet demi Lima Besar</h4>
											<p class="card-text">Sebagai konsultan teknik PON XXI/2024 Aceh-Sumatra Utara, Dikdik Zafar Sidik, kontingen KONI Kaltim, ditugaskan untuk memastikan performa atlet dalam kondisi terbaik.</p>
										<p class="card-text op-07"><small class="text-body-secondary">Last updated 20 mins ago</small></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row g-4">
									<div class="col-12">
										<div class="card border-0 overflow-hidden">
											<div class="row g-0">
												<div class="col-md-4">
													<img src="{{ asset('demos/football-club/images/atlet.png') }}" class="object-fit-cover w-100 h-100" alt="...">
												</div>
												<div class="col-md-8">
													<div class="card-body p-4">
														<h4 class="card-title font-body mb-3">Pelatih Rasakan Manfaat Coaching Clinic KONI Kaltim</h4>
														<p class="card-text">Peningkatan kualitas sumber daya manusia (SDM) garapan KONI Kaltim diakui memberi warna baru bagi pelatih.</p>
														<p class="card-text op-07"><small class="text-body-secondary">Last updated 56mins ago</small></p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="card border-0 overflow-hidden">
											<div class="row g-0">
												<div class="col-md-4">
													<img src="{{ asset('demos/football-club/images/oranye_pusamania.png') }}" class="object-fit-cover w-100 h-100" alt="...">
												</div>
												<div class="col-md-8">
													<div class="card-body p-4">
														<h4 class="card-title font-body mb-3">Oranyekan Batakan, Borneo FC Beri Pujian Untuk Pusamania</h4>
														<p class="card-text">Tiga poin yang didapat Borneo FC Samarinda atas Persija Jakarta di Stadion Batakan, Balikpapan (6/2), tidak lepas dari andil Pusamania. Suporter setia tim berjuluk Pesut Etam tersebut sukses menghadirkan atmosfer Stadion Segiri.</p>
														<p class="card-text op-07"><small class="text-body-secondary">Last updated 10 mins ago</small></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Achievements Section
				============================================= -->
				<div class="section dark my-0" style="background: linear-gradient(rgba(21, 57, 38, 0.1), rgba(19, 49, 34,.7)), url('{{ asset('demos/football-club/images/stadium.jpg') }}') no-repeat center 85% / cover;">
					<div class="container">
						<div class="text-center mb-6">
							<h3 class="fs-2 text-decoration-underline text-underline-offset-5 text-uppercase fw-800">Gelaran Kejuaraan</h3>
						</div>
						<div class="row text-center">
							<div class="col-lg-3 col-6">
								<img src="{{ asset('demos/football-club/images/awards/1.png') }}" alt="..." height="200" class="mb-3">
								<h3>Kejuaraan A</h3>
							</div>

							<div class="col-lg-3 col-6">
								<img src="{{ asset('demos/football-club/images/awards/2.png') }}" alt="..." height="200" class="mb-3">
								<h3>Kejuaraan B</h3>
							</div>

							<div class="col-lg-3 col-6">
								<img src="{{ asset('demos/football-club/images/awards/3.png') }}" alt="..." height="200" class="mb-3">
								<h3>Kejuaraan C</h3>
							</div>

							<div class="col-lg-3 col-6">
								<img src="{{ asset('demos/football-club/images/awards/4.png') }}" alt="..." height="200" class="mb-3">
								<h3>Kejuaraan D</h3>
							</div>
						</div>
					</div>
					<div class="scroll-detect position-absolute top-50 op-02 translate-middle-y">
						<div class="row flex-nowrap transform-ts align-items-center font-primary scroll-text" style="transform: translateX(calc(var(--cnvs-scroll-percent) * 2px)); margin-left: -50%;">
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Pencapaian</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
							<div class="col-auto fw-bold text-uppercase ls-1 display-2 px-4 d-inline">Achievements</div><span class="col-auto"><i class="fa-solid fa-circle"></i></span>
						</div>
					</div>
				</div>

				<!-- Video Gallery Section
				============================================= -->
				<div class="section bg-transparent my-0">
					<div class="container">
						<div class="text-center mb-6">
							<h3 class="fs-2 text-decoration-underline text-underline-offset-5 text-uppercase fw-800">Galeri Video</h3>
						</div>
						<div class="carousel-widget owl-carousel" data-items="1" data-items-md="2" data-items-lg="3" data-nav="false">

							<a href="https://www.youtube.com/?v=JNA67SNg2Ig" data-lightbox="iframe" class="d-block position-relative ratio ratio-16x9">
								<img src="http://img.youtube.com/vi/JNA67SNg2Ig/0.jpg" alt="Youtube Video" style="object-fit: cover; object-position: center center;">
								<div class="bg-overlay">
									<div class="bg-overlay-content">
										<div class="overlay-trigger-icon bg-light text-dark size-lg op-1" data-hover-animate="op-1 scale-lg" data-hover-animate-out="op-08" data-hover-parent=".bg-overlay"><i class="fa-solid fa-play position-relative" style="left:1px;"></i></div>
									</div>
								</div>
							</a>
							<a href="https://www.youtube.com/?v=Ff_CRZQ01mw" data-lightbox="iframe" class="d-block position-relative ratio ratio-16x9">
								<img src="http://img.youtube.com/vi/Ff_CRZQ01mw/0.jpg" alt="Youtube Video" style="object-fit: cover; object-position: center center;">
								<div class="bg-overlay">
									<div class="bg-overlay-content">
										<div class="overlay-trigger-icon bg-light text-dark size-lg op-1" data-hover-animate="op-1 scale-lg" data-hover-animate-out="op-08" data-hover-parent=".bg-overlay"><i class="fa-solid fa-play position-relative" style="left:1px;"></i></div>
									</div>
								</div>
							</a>
							<a href="https://www.youtube.com/?v=ol4Dx3EkQUE" data-lightbox="iframe" class="d-block position-relative ratio ratio-16x9">
								<img src="http://img.youtube.com/vi/ol4Dx3EkQUE/0.jpg" alt="Youtube Video" style="object-fit: cover; object-position: center center;">
								<div class="bg-overlay">
									<div class="bg-overlay-content">
										<div class="overlay-trigger-icon bg-light text-dark size-lg op-1" data-hover-animate="op-1 scale-lg" data-hover-animate-out="op-08" data-hover-parent=".bg-overlay"><i class="fa-solid fa-play position-relative" style="left:1px;"></i></div>
									</div>
								</div>
							</a>
							<a href="https://www.youtube.com/?v=q6YHGyfIqF4" data-lightbox="iframe" class="d-block position-relative ratio ratio-16x9">
								<img src="http://img.youtube.com/vi/q6YHGyfIqF4/0.jpg" alt="Youtube Video" style="object-fit: cover; object-position: center center;">
								<div class="bg-overlay">
									<div class="bg-overlay-content">
										<div class="overlay-trigger-icon bg-light text-dark size-lg op-1" data-hover-animate="op-1 scale-lg" data-hover-animate-out="op-08" data-hover-parent=".bg-overlay"><i class="fa-solid fa-play position-relative" style="left:1px;"></i></div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>

				<!-- Promo Section
				============================================= -->
				<div class="container mb-4">
					<div class="promo px-5" style="background: linear-gradient(transparent 20%, #FD954A 20%, #FD612B);">
						<div class="row align-items-center">
							<div class="col-12 col-lg-5 d-none d-lg-block">
								<img src="{{ asset('demos/football-club/images/promo.png') }}" alt="..." class="ms-lg-4">
							</div>
							<div class="col-1"></div>
							<div class="col-12 col-lg-6 pb-4 pb-lg-0" style="padding-top: 70px;">
								<h2 class="text-dark text-uppercase ls-1 mb-2">Ingin Selalu Update?</h2>
								<p class="lead">Update olahraga terbaru wilayah Kaltim disini.</p>
								<div class="widget-subscribe-form-result"></div>
								<form id="widget-subscribe-form" action="include/subscribe.php" method="post" class="mb-0">
									<div class="input-group input-group-lg">
										<div class="bg-white transform-skew flex-grow-1">
											<input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email border-0 rounded-0 bg-transparent form-control-lg w-100" placeholder="Masukkan Email Anda">
										</div>
										<button class="btn btn-dark transform-skew rounded-0" type="submit"><span>Subscribe</span></button>
									</div>
								</form>
							</div>
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
	<div id="gotoTop" class="uil uil-angle-up rounded-circle"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{ asset('js/web/plugins.min.js') }}"></script>
	<script src="{{ asset('js/web/functions.bundle.js') }}"></script>

	<!-- Charts JS
	============================================= -->
	<script src="{{ asset('js/web/chart.js') }}"></script>
	<script src="{{ asset('js/web/chart-utils.js') }}"></script>

	<script>

		var MONTHS = ["Akuatik Renang", "Anggar", "Angkat Besi", "Basket", "Bola Tangan", "Bola Volley", "Bowling", "Bulu Tangkis", "Catur", "Dance Sport", "Dayung", "Canoe"];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ["Akuatik Renang", "Anggar", "Angkat Besi", "Basket", "Bola Tangan", "Bola Volley", "Bowling", "Bulu Tangkis", "Catur", "Dance Sport", "Dayung", "Canoe"],
			datasets: [{
				label: 'Cabang Olahraga',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
					35,
					58,
					76,
					65,
					35,
					98,
					34,
					65,
					34,
					86,
					77,
					89
				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById("chart-0").getContext("2d");
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Grafik Atlet Terdaftar'
					}
				}
			});

		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			var zero = Math.random() < 0.2 ? true : false;
			barChartData.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return zero ? 0.0 : randomScalingFactor();
				});

			});
			window.myBar.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var colorName = colorNames[barChartData.datasets.length % colorNames.length];;
			var dsColor = window.chartColors[colorName];
			var newDataset = {
				label: 'Dataset ' + barChartData.datasets.length,
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: []
			};

			for (var index = 0; index < barChartData.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
			}

			barChartData.datasets.push(newDataset);
			window.myBar.update();
		});

		document.getElementById('addData').addEventListener('click', function() {
			if (barChartData.datasets.length > 0) {
				var month = MONTHS[barChartData.labels.length % MONTHS.length];
				barChartData.labels.push(month);

				for (var index = 0; index < barChartData.datasets.length; ++index) {
					//window.myBar.addData(randomScalingFactor(), index);
					barChartData.datasets[index].data.push(randomScalingFactor());
				}

				window.myBar.update();
			}
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			barChartData.datasets.splice(0, 1);
			window.myBar.update();
		});

		document.getElementById('removeData').addEventListener('click', function() {
			barChartData.labels.splice(-1, 1); // remove the label first

			barChartData.datasets.forEach(function(dataset, datasetIndex) {
				dataset.data.pop();
			});

			window.myBar.update();
		});

	</script>

</body>
</html>
