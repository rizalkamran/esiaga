<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReffCaborController;
use App\Http\Controllers\ReffPeranController;
use App\Http\Controllers\AnggotaPeranController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ReffKotaController;
use App\Http\Controllers\ReffProvinsiController;
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
});

Route::get('/mobile-intro', function () {
    return view('mobile.intro');
})->name('mobile-intro'); // Define a name for the route


Route::get('/mobile-login', function () {
    return view('mobile.auth.login');
})->name('mobile-login');

Route::get('/mobile-register', function () {
    return view('mobile.auth.register');
})->name('mobile-register');

/**
 * Add 'verified'
 * to create soft lock
 * create [] in middleware
 * this (['auth', 'verified'])
 */

//Admin
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::resource('/users', UserController::class);
});

//staf
Route::prefix('publik')->middleware('auth')->name('publik.')->group(function(){
    // Define your routes here
    Route::resource('/anggota_peran', AnggotaPeranController::class);
});

//Acara
Route::resource('/acara', AcaraController::class);
//Biodata
Route::get('/get-kota/{provinsiId}', [BiodataController::class, 'getKota']);
Route::resource('/biodata', BiodataController::class);
//Route::get('/download/image/{imageName}', 'BiodataController@downloadImage')->name('download.image');


//Referensi
Route::resource('cabor', ReffCaborController::class);
Route::resource('peran', ReffPeranController::class);
Route::resource('data-provinsi', ReffProvinsiController::class);
Route::resource('data-kota', ReffKotaController::class);



