<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\Acara2Controller;
use App\Http\Controllers\SesiAcaraController;
use App\Http\Controllers\SesiAcara2Controller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserStafController;
use App\Http\Controllers\ReffCaborController;
use App\Http\Controllers\ReffPeranController;
use App\Http\Controllers\ReffAtlitController;
use App\Http\Controllers\ReffPemenangController;
use App\Http\Controllers\AnggotaPeranController;
use App\Http\Controllers\AnggotaPeranAdminController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\BiodataAdminController;
use App\Http\Controllers\BiodataStafController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DiklatAdminController;
use App\Http\Controllers\LisensiUserController;
use App\Http\Controllers\LisensiAdminController;
use App\Http\Controllers\PendidikanAdminController;
use App\Http\Controllers\PendidikanUserController;
use App\Http\Controllers\PrestasiAdminController;
use App\Http\Controllers\PrestasiUserController;
use App\Http\Controllers\PekerjaanAdminController;
use App\Http\Controllers\PekerjaanUserController;
use App\Http\Controllers\ReffKotaController;
use App\Http\Controllers\ReffProvinsiController;
use App\Http\Controllers\ReffPendidikanController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\Registrasi2Controller;
use App\Http\Controllers\RegistrasiStafController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\Kehadiran2Controller;
use App\Http\Controllers\TandaTerimaAdminController;
use App\Http\Controllers\KategoriAdminController;
use App\Http\Controllers\DaftarJuaraAdminController;
use App\Http\Controllers\DaftarAtlitController;
use App\Http\Controllers\GaleriAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $request = request(); // Get the current request instance

    // Check if the User-Agent header contains the 'Mobile' keyword
    if ($request->header('User-Agent') && strpos($request->header('User-Agent'), 'Mobile') !== false) {
        return Redirect::to('/mobile-landing');
    } else {
        // If not using a mobile device, or User-Agent is not available, serve desktop landing page
        return view('/index2');
    }
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/mobile-landing', function () {
    return view('mobile.index');
})->name('mobile-landing');

Route::get('/mobile-board', function () {
    return view('mobile.board');
})->name('mobile-board');

Route::get('/mobile-intro', function () {
    return view('mobile.intro');
})->name('mobile-intro');

Route::get('/mobile-terms', function () {
    return view('mobile.terms');
})->name('mobile-terms');

Route::get('/mobile-setting', function () {
    return view('mobile.setting');
})->name('mobile-setting');

Route::get('/mobile-profil', function () {
    return view('mobile.profil');
})->name('mobile-profil')->middleware('auth');

Route::get('/mobile-login', function () {
    return view('mobile.auth.login');
})->name('mobile-login');

Route::get('/mobile-register', function () {
    return view('mobile.auth.register');
})->name('mobile-register');

Route::get('/mobile-forget', function () {
    return view('mobile.auth.forget');
})->name('mobile-forget');

Route::get('/web-landing', function () {
    return view('index');
})->name('web-landing')->middleware('auth');
/**
 * Add 'verified'
 * to create soft lock
 * create [] in middleware
 * this (['auth', 'verified'])
 */

//Admin - User
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::resource('/users', UserController::class);
});

//Staf - User
Route::prefix('staf')->middleware('auth')->name('staf.')->group(function(){
    Route::resource('/users', UserStafController::class);
    Route::resource('/biodata', BiodataStafController::class);
    Route::get('/biodata', [BiodataStafController::class, 'index'])->name('biodata.index');
    Route::resource('/registrasi', RegistrasiStafController::class);
    //Route::get('/registrasi/export-pdf', [RegistrasiStafController::class, 'exportStafPDF'])->name('registrasi.export-pdf');
});

Route::get('mobile/auth/edit/{id}', [UserController::class, 'edit'])->name('mobile.edit.profile')->middleware('auth');
Route::patch('mobile/update/profile/{id}', [UserController::class, 'updateMobile'])->name('mobile.update.profile')->middleware('auth');

// Route for displaying the registration form for mobile users
Route::get('/mobile/new-user/register', [UserController::class, 'createMobile'])->name('mobile.new-user.register');
Route::get('/desktop/register', [UserController::class, 'createWeb'])->name('desktop.register');

// Route for handling the form submission for mobile user registration
Route::post('/mobile/new-user/register', [UserController::class, 'storeMobile'])->name('mobile.new-user.store');
Route::post('/desktop/register', [UserController::class, 'storeWeb'])->name('desktop.user.store');


//staf
Route::prefix('publik')->middleware('auth')->name('publik.')->group(function(){
    // Define your routes here
    Route::resource('/anggota_peran', AnggotaPeranController::class);
});

// Acara
Route::resource('/acara', AcaraController::class);
Route::get('/mobile/acara', [AcaraController::class, 'index'])->name('mobile.acara.index');
Route::get('/acara', [AcaraController::class, 'admin'])->name('acara.index')->middleware('auth');
//Route::post('/mobile/acara/kehadiran', [AcaraController::class, 'kehadiran'])->name('mobile.acara.kehadiran'); // New route for recording attendance

Route::resource('/acara2', Acara2Controller::class);

//Sesi Acara
Route::resource('/sesi_acara', SesiAcaraController::class);
Route::resource('/sesi_acara2', SesiAcara2Controller::class);

//Tanda Terima
Route::resource('/tanda_terima', TandaTerimaAdminController::class);
Route::get('/export-pdf-tandaterima', [TandaTerimaAdminController::class, 'exportPDF'])->name('tandaterima.export-pdf');

// Kode Acara
//Route::resource('/kode-acara', KodeAcaraController::class);

// Anggota
Route::resource('/anggota_peran', AnggotaPeranAdminController::class);
Route::get('/anggota_peran', [AnggotaPeranAdminController::class, 'index'])->name('anggota_peran.index');
Route::get('/mobile/anggota', [AnggotaPeranController::class, 'index'])->name('mobile.anggota.index');
Route::get('/mobile/anggota/create', [AnggotaPeranController::class, 'create'])->name('mobile.anggota.create');
Route::post('/mobile/anggota', [AnggotaPeranController::class, 'store'])->name('mobile.anggota.store');
Route::get('/mobile/anggota/{anggotaPeran}/edit', [AnggotaPeranController::class, 'edit'])->name('mobile.anggota.edit');
Route::put('/mobile/anggota/{anggotaPeran}', [AnggotaPeranController::class, 'update'])->name('mobile.anggota.update');


// Registrasi - pelatih
Route::resource('/registrasi', RegistrasiController::class)->middleware('can:is-admin');
Route::get('/registrasi/create', [RegistrasiController::class, 'createAdmin'])->middleware('can:is-admin')->name('registrasi.create');
// Store Registrasi by Admin
Route::post('/registrasi', [RegistrasiController::class, 'storeAdmin'])->middleware('can:is-admin')->name('registrasi.store.admin');
Route::get('/export-pdf-regis', [RegistrasiController::class, 'exportPDF'])->name('regis.export-pdf');
// Route for exporting PDF without gate middleware
Route::get('/export-pdf-public', [RegistrasiController::class, 'exportPDFPublic'])->name('export.pdf.public');
Route::get('/export-user-pdf-regis/{id}', [RegistrasiController::class, 'exportUser'])->name('regis.export-user-pdf');
//mobile
Route::post('/mobile/acara/register', [AcaraController::class, 'register'])->name('mobile.acara.register');
Route::get('/mobile/acara/detail', [RegistrasiController::class, 'showUserEvents'])->name('mobile.acara.detail');
// Edit Registrasi
Route::get('/registrasi/{id}/edit', [RegistrasiController::class, 'edit'])->middleware('can:is-admin')->name('registrasi.edit');
// Update Registrasi
Route::put('/registrasi/{id}', [RegistrasiController::class, 'update'])->middleware('can:is-admin')->name('registrasi.update');

// Registrasi - juara
Route::resource('/registrasi2', Registrasi2Controller::class)->middleware('can:is-admin');
Route::get('/export-pdf-regis2', [Registrasi2Controller::class, 'exportPDF'])->name('regis2.export-pdf');
Route::get('/export-pdf-public2', [Registrasi2Controller::class, 'exportPDFPublic'])->name('export2.pdf.public');
Route::get('/export-user-pdf-regis2/{id}', [Registras2Controller::class, 'exportUser'])->name('regis2.export-user-pdf');

// Kehadiran - pelatih
Route::resource('/kehadiran', KehadiranController::class);
// Route for displaying the absen form
Route::get('/absen', [KehadiranController::class, 'absen'])->name('absen.index');
// Route for storing absen data
Route::post('/absen', [KehadiranController::class, 'storeAbsen'])->name('absen.store');
Route::get('/export-pdf-absen', [KehadiranController::class, 'exportPDF'])->middleware('can:is-admin')->name('absen.export-pdf');

// Kehadiran - pelatih
Route::resource('/kehadiran2', Kehadiran2Controller::class);
Route::get('/export-pdf-absen2', [Kehadiran2Controller::class, 'exportPDF'])->middleware('can:is-admin')->name('absen2.export-pdf');

// Biodata Admin
Route::resource('/biodata_admin', BiodataAdminController::class);
Route::get('/biodata_admin', [BiodataAdminController::class, 'index'])->name('biodata_admin.index');
Route::get('/biodata_admin/{id}/edit', [BiodataAdminController::class, 'edit'])->name('biodata_admin.edit');
Route::get('/biodata_admin/{id}', [BiodataAdminController::class, 'update'])->name('biodata_admin.update');

// Biodata
Route::resource('/biodata', BiodataController::class);
Route::get('/mobile/biodata', [BiodataController::class, 'index'])->name('mobile.biodata.index');
Route::get('/mobile/biodata/create', [BiodataController::class, 'create'])->name('mobile.biodata.create');
Route::post('/mobile/biodata', [BiodataController::class, 'store'])->name('mobile.biodata.store');
Route::get('/mobile/biodata/{id}/edit', [BiodataController::class, 'edit'])->name('mobile.biodata.edit');
Route::put('/mobile/biodata/{id}', [BiodataController::class, 'update'])->name('mobile.biodata.update');
//Route::get('/mobile/biodata/get-kota/{provinsi_id}', [BiodataController::class, 'getKota']);
//Route::get('/download/image/{imageName}', 'BiodataController@downloadImage')->name('download.image');

// Diklat
Route::resource('/diklat', DiklatAdminController::class);
Route::get('/diklat', [DiklatAdminController::class, 'index'])->name('diklat.index');
Route::get('/mobile/diklat', [DiklatController::class, 'index'])->name('mobile.diklat.index');
Route::get('/mobile/diklat/create', [DiklatController::class, 'create'])->name('mobile.diklat.create');
Route::post('/mobile/diklat', [DiklatController::class, 'store'])->name('mobile.diklat.store');

// lisensi
Route::resource('/lisensi', LisensiAdminController::class);
Route::get('/lisensi', [LisensiAdminController::class, 'index'])->name('lisensi.index');
Route::get('/mobile/lisensi', [LisensiUserController::class, 'index'])->name('mobile.lisensi.index');
Route::get('/mobile/lisensi/create', [LisensiUserController::class, 'create'])->name('mobile.lisensi.create');
Route::post('/mobile/lisensi', [LisensiUserController::class, 'store'])->name('mobile.lisensi.store');

// pendidikan
Route::resource('/pendidikan', PendidikanAdminController::class);
Route::get('/pendidikan', [PendidikanAdminController::class, 'index'])->name('pendidikan.index');
Route::get('/mobile/pendidikan', [PendidikanUserController::class, 'index'])->name('mobile.pendidikan.index');
Route::get('/mobile/pendidikan/create', [PendidikanUserController::class, 'create'])->name('mobile.pendidikan.create');
Route::post('/mobile/pendidikan', [PendidikanUserController::class, 'store'])->name('mobile.pendidikan.store');

// prestasi
Route::resource('/prestasi', PrestasiAdminController::class);
Route::get('/prestasi', [PrestasiAdminController::class, 'index'])->name('prestasi.index');
Route::get('/mobile/prestasi', [PrestasiUserController::class, 'index'])->name('mobile.prestasi.index');
Route::get('/mobile/prestasi/create', [PrestasiUserController::class, 'create'])->name('mobile.prestasi.create');
Route::post('/mobile/prestasi', [PrestasiUserController::class, 'store'])->name('mobile.prestasi.store');

// pekerjaan
Route::resource('/pekerjaan', PekerjaanAdminController::class);
Route::get('/pekerjaan', [PekerjaanAdminController::class, 'index'])->name('pekerjaan.index');
Route::get('/mobile/pekerjaan', [PekerjaanUserController::class, 'index'])->name('mobile.pekerjaan.index');
Route::get('/mobile/pekerjaan/create', [PekerjaanUserController::class, 'create'])->name('mobile.pekerjaan.create');
Route::post('/mobile/pekerjaan', [PekerjaanUserController::class, 'store'])->name('mobile.pekerjaan.store');

// daftar_juara
Route::resource('/daftar_juara', DaftarJuaraAdminController::class);
Route::get('/daftar_juara', [DaftarJuaraAdminController::class, 'index'])->name('daftar_juara.index');
Route::get('/get-kategori/{acara_id}', [DaftarJuaraAdminController::class, 'getKategori'])->name('get.kategori');
Route::get('/export-pdf-juara', [DaftarJuaraAdminController::class, 'exportPDF'])->name('daftar_juara.export-pdf');

// daftar_atlit
Route::resource('/daftar_atlit', DaftarAtlitController::class);
Route::get('/daftar_atlit', [DaftarAtlitController::class, 'index'])->name('daftar_atlit.index');
Route::get('/get-kategori/{acara_id}', [DaftarAtlitController::class, 'getKategori'])->name('get.kategori');

// daftar_atlit
Route::resource('/galeri', GaleriAdminController::class);

//Referensi
Route::resource('cabor', ReffCaborController::class);
Route::resource('peran', ReffPeranController::class);
Route::resource('data-provinsi', ReffProvinsiController::class);
Route::resource('data-kota', ReffKotaController::class);
Route::resource('reffdidik', ReffPendidikanController::class);
Route::resource('kategori', KategoriAdminController::class);
Route::resource('reff_atlit', ReffAtlitController::class);
Route::resource('reff_pemenang', ReffPemenangController::class);



