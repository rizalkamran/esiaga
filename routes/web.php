<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\SesiAcaraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserStafController;
use App\Http\Controllers\ReffCaborController;
use App\Http\Controllers\ReffPeranController;
use App\Http\Controllers\AnggotaPeranController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\BiodataAdminController;
use App\Http\Controllers\BiodataStafController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DiklatAdminController;
use App\Http\Controllers\LisensiUserController;
use App\Http\Controllers\LisensiAdminController;
use App\Http\Controllers\PendidikanAdminController;
use App\Http\Controllers\PendidikanUserController;
use App\Http\Controllers\ReffKotaController;
use App\Http\Controllers\ReffProvinsiController;
use App\Http\Controllers\ReffPendidikanController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\RegistrasiStafController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\TandaTerimaAdminController;
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
})->name('web-landing');
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

//Sesi Acara
Route::resource('/sesi_acara', SesiAcaraController::class);

//Tanda Terima
Route::resource('/tanda_terima', TandaTerimaAdminController::class);

// Kode Acara
//Route::resource('/kode-acara', KodeAcaraController::class);

// Anggota
Route::get('/mobile/anggota', [AnggotaPeranController::class, 'index'])->name('mobile.anggota.index');
Route::get('/mobile/anggota/create', [AnggotaPeranController::class, 'create'])->name('mobile.anggota.create');
Route::post('/mobile/anggota', [AnggotaPeranController::class, 'store'])->name('mobile.anggota.store');
Route::get('/mobile/anggota/{anggotaPeran}/edit', [AnggotaPeranController::class, 'edit'])->name('mobile.anggota.edit');
Route::put('/mobile/anggota/{anggotaPeran}', [AnggotaPeranController::class, 'update'])->name('mobile.anggota.update');


// Registrasi
Route::resource('/registrasi', RegistrasiController::class)->middleware('can:is-admin');
Route::get('/registrasi/create', [RegistrasiController::class, 'createAdmin'])->middleware('can:is-admin')->name('registrasi.create');
// Store Registrasi by Admin
Route::post('/registrasi', [RegistrasiController::class, 'storeAdmin'])->middleware('can:is-admin')->name('registrasi.store.admin');
Route::get('/export-pdf-regis', [RegistrasiController::class, 'exportPDF'])->name('regis.export-pdf');
Route::get('/export-user-pdf-regis/{id}', [RegistrasiController::class, 'exportUser'])->name('regis.export-user-pdf');
//mobile
Route::post('/mobile/acara/register', [AcaraController::class, 'register'])->name('mobile.acara.register');
Route::get('/mobile/acara/detail', [RegistrasiController::class, 'showUserEvents'])->name('mobile.acara.detail');
// Edit Registrasi
Route::get('/registrasi/{id}/edit', [RegistrasiController::class, 'edit'])->middleware('can:is-admin')->name('registrasi.edit');
// Update Registrasi
Route::put('/registrasi/{id}', [RegistrasiController::class, 'update'])->middleware('can:is-admin')->name('registrasi.update');


// Kehadiran
Route::resource('/kehadiran', KehadiranController::class)->middleware('can:is-admin');
// Route for displaying the absen form
Route::get('/absen', [KehadiranController::class, 'absen'])->name('absen.index');
// Route for storing absen data
Route::post('/absen', [KehadiranController::class, 'storeAbsen'])->name('absen.store');
Route::get('/export-pdf-absen', [KehadiranController::class, 'exportPDF'])->middleware('can:is-admin')->name('absen.export-pdf');

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

//Referensi
Route::resource('cabor', ReffCaborController::class);
Route::resource('peran', ReffPeranController::class);
Route::resource('data-provinsi', ReffProvinsiController::class);
Route::resource('data-kota', ReffKotaController::class);
Route::resource('reffdidik', ReffPendidikanController::class);



