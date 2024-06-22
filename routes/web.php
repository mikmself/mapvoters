<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/auth/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/api/auth/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::get('/api/auth/logout', [App\Http\Controllers\AuthController::class, 'logout']);

//Route Tambahan
Route::get('/api/pemetaan-provinsi/{idPaslon}', [\App\Http\Controllers\WilayahController::class, 'pemetaanProvinsi']);
Route::get('/api/pemetaan-kabupaten/{idPaslon}', [\App\Http\Controllers\WilayahController::class,'pemetaanKabupaten']);
Route::get('/api/pemetaan-kecamatan/{idPaslon}', [\App\Http\Controllers\WilayahController::class,'pemetaanKecamatan']);
Route::get('/api/pemetaan-kelurahan/{idPaslon}', [\App\Http\Controllers\WilayahController::class,'pemetaanKelurahan']);

#buatkan route untuk mengakses method get provinsi sampai kelurahan di wilayah controller
Route::get('/api/get-provinsi', [\App\Http\Controllers\WilayahController::class, 'getProvinsi']);
Route::get('/api/get-kabupaten-provinsi/{idProvinsi}', [\App\Http\Controllers\WilayahController::class, 'getKabupaten']);
Route::get('/api/get-kecamatan-kabupaten/{idKabupaten}', [\App\Http\Controllers\WilayahController::class, 'getKecamatan']);
Route::get('/api/get-kelurahan-kecamatan/{idKecamatan}', [\App\Http\Controllers\WilayahController::class, 'getKelurahan']);

Route::get('/api/get-suarabytps/{idPaslon}/{idKelurahan}', [App\Http\Controllers\AmbilSuaraController::class, 'getDataTPS'],);
Route::get('/api/get-dashboard-data/{idPaslon}', [App\Http\Controllers\DashboardController::class, 'getDashboardData']);
Route::post('/api/koordinator/search', [App\Http\Controllers\KoordinatorController::class, 'search']);

Route::get('/api/pemetaan-c1-provinsi/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Provinsi']);
Route::get('/api/pemetaan-c1-kabupaten/{idProvinsi}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Kabupaten']);
Route::get('/api/pemetaan-c1-kecamatan/{idKabupaten}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Kecamatan']);
Route::get('/api/pemetaan-c1-kelurahan/{idKecamatan}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Kelurahan']);
Route::get('/api/pemetaan-c1-TPS/{idKelurahan}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1TPS']);

Route::post('/api/v2/registerpaslon', [App\Http\Controllers\PaslonController::class, 'store']);
