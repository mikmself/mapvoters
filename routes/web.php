<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
