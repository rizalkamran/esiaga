@extends('templates.mobile')

@section('body_class', 'sc5-2')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="term-condition-page">
        <div class="container">
            <a class="btn back-page-btn" href="{{ route('mobile-intro') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>E-SIAGA</h3>
            <h4>Terms and Conditions</h4>
            <div style="text-align: justify;">
                <ul>
                    <li>
                        Penggunaan aplikasi web ini menandakan persetujuan pengguna terhadap semua syarat dan ketentuan yang tercantum di sini.
                    </li>
                    <li>
                        Pengguna bertanggung jawab penuh atas keamanan akun dan informasi pribadi yang diberikan saat menggunakan aplikasi web ini.
                    </li>
                    <li>
                        Kami berhak untuk menangguhkan atau mengakhiri akses pengguna ke aplikasi web ini jika ditemukan pelanggaran terhadap syarat dan ketentuan ini.
                    </li>
                    <li>
                        Kami berhak untuk memperbarui, mengubah, atau menghapus syarat dan ketentuan ini tanpa pemberitahuan sebelumnya. Pengguna diharapkan memeriksa halaman syarat dan ketentuan secara berkala
                    </li>
                </ul>
            </div>
            <div class="btn-wrap">
                <a class="btn btn-border" href="{{ route('mobile-landing') }}">Batal</a>
                <a class="btn btn-base" href="{{ route('mobile.new-user.register') }}">Setuju</a>
            </div>
        </div>
    </div>

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

@endsection
