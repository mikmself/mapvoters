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
