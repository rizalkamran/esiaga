<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\SesiAcaraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReffCaborController;
use App\Http\Controllers\ReffPeranController;
use App\Http\Controllers\AnggotaPeranController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\ReffKotaController;
use App\Http\Controllers\ReffProvinsiController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KodeAcaraController;
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


// Kode Acara
Route::resource('/kode-acara', KodeAcaraController::class);

// Anggota
Route::get('/mobile/anggota', [AnggotaPeranController::class, 'index'])->name('mobile.anggota.index');
Route::get('/mobile/anggota/create', [AnggotaPeranController::class, 'create'])->name('mobile.anggota.create');
Route::post('/mobile/anggota', [AnggotaPeranController::class, 'store'])->name('mobile.anggota.store');
Route::get('/mobile/anggota/{anggotaPeran}/edit', [AnggotaPeranController::class, 'edit'])->name('mobile.anggota.edit');
Route::put('/mobile/anggota/{anggotaPeran}', [AnggotaPeranController::class, 'update'])->name('mobile.anggota.update');


// Registrasi
Route::resource('/registrasi', RegistrasiController::class)->middleware('can:is-admin');
Route::get('/export-pdf-regis', [RegistrasiController::class, 'exportPDF'])->middleware('can:is-admin')->name('regis.export-pdf');
Route::post('/mobile/acara/register', [AcaraController::class, 'register'])->name('mobile.acara.register');
// Edit Registrasi
Route::get('/registrasi/{id}/edit', [RegistrasiController::class, 'edit'])->middleware('can:is-admin')->name('registrasi.edit');
// Update Registrasi
Route::put('/registrasi/{id}', [RegistrasiController::class, 'update'])->middleware('can:is-admin')->name('registrasi.update');


// Kehadiran
Route::resource('/kehadiran', KehadiranController::class)->middleware('can:is-admin');
Route::get('/export-pdf-absen', [KehadiranController::class, 'exportPDF'])->middleware('can:is-admin')->name('absen.export-pdf');

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
Route::resource('/diklat', DiklatController::class);
Route::get('/mobile/diklat', [DiklatController::class, 'index'])->name('mobile.diklat.index');
Route::get('/mobile/diklat/create', [DiklatController::class, 'create'])->name('mobile.diklat.create');
Route::post('/mobile/diklat', [DiklatController::class, 'store'])->name('mobile.diklat.store');


//Referensi
Route::resource('cabor', ReffCaborController::class);
Route::resource('peran', ReffPeranController::class);
Route::resource('data-provinsi', ReffProvinsiController::class);
Route::resource('data-kota', ReffKotaController::class);



