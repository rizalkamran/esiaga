<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReffCaborController;
use App\Http\Controllers\ReffPeranController;
use App\Http\Controllers\AnggotaPeranController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ReffKotaController;
use App\Http\Controllers\ReffProvinsiController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\KodeAcaraController;
use Illuminate\Support\Facades\Route;

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
        return view('index');
    }
});

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

// Route for displaying the registration form for mobile users
Route::get('/mobile/new-user/register', [UserController::class, 'createMobile'])->name('mobile.new-user.register');

// Route for handling the form submission for mobile user registration
Route::post('/mobile/new-user/register', [UserController::class, 'storeMobile'])->name('mobile.new-user.store');


//staf
Route::prefix('publik')->middleware('auth')->name('publik.')->group(function(){
    // Define your routes here
    Route::resource('/anggota_peran', AnggotaPeranController::class);
});

//Acara
Route::resource('/acara', AcaraController::class);
Route::get('/mobile/acara', [AcaraController::class, 'index'])->name('mobile.acara.index');
Route::get('/acara', [AcaraController::class, 'admin'])->name('acara.index');

//Kode Acara
Route::resource('/kode-acara', KodeAcaraController::class);

//Anggota
Route::get('/mobile/anggota', [AnggotaPeranController::class, 'index'])->name('mobile.anggota.index');
Route::get('/mobile/anggota/create', [AnggotaPeranController::class, 'create'])->name('mobile.anggota.create');
Route::post('/mobile/anggota', [AnggotaPeranController::class, 'store'])->name('mobile.anggota.store');

//Registrasi
Route::resource('/registrasi', RegistrasiController::class);
Route::get('/export-pdf', [RegistrasiController::class, 'exportPDF'])->middleware('can:is-admin')->name('export-pdf');
Route::post('/mobile/acara/register', [AcaraController::class, 'register'])->name('mobile.acara.register');
Route::post('/mobile/acara/register', [AcaraController::class, 'register'])->name('mobile.acara.register.store');

//Biodata
Route::resource('/biodata', BiodataController::class);
Route::get('/mobile/biodata', [BiodataController::class, 'index'])->name('mobile.biodata.index');
Route::get('/mobile/biodata/create', [BiodataController::class, 'create'])->name('mobile.biodata.create');
Route::post('/mobile/biodata', [BiodataController::class, 'store'])->name('mobile.biodata.store');
//Route::get('/mobile/biodata/get-kota/{provinsi_id}', [BiodataController::class, 'getKota']);
//Route::get('/download/image/{imageName}', 'BiodataController@downloadImage')->name('download.image');


//Referensi
Route::resource('cabor', ReffCaborController::class);
Route::resource('peran', ReffPeranController::class);
Route::resource('data-provinsi', ReffProvinsiController::class);
Route::resource('data-kota', ReffKotaController::class);



