<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route Tambahan
Route::get('/pemetaan-provinsi/{idPaslon}', 'WilayahController@pemetaanProvinsi');
Route::get('/pemetaan-kabupaten/{idPaslon}', 'WilayahController@pemetaanKabupaten');
Route::get('/pemetaan-kecamatan/{idPaslon}', 'WilayahController@pemetaanKecamatan');
Route::get('/pemetaan-kelurahan/{idPaslon}', 'WilayahController@pemetaanKelurahan');
