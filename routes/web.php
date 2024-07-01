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


Route::get('/api/v2/saksi/{id}', [App\Http\Controllers\SaksiController::class, 'show']);
Route::post('/api/v2/saksi', [App\Http\Controllers\SaksiController::class, 'store']);
Route::get('/api/v2/pemilih-potensial/{idPaslon}', [App\Http\Controllers\PemilihPotensialController::class, 'getAllData']);
Route::post('/api/pemilih-potensial', [App\Http\Controllers\PemilihPotensialController::class, 'store']);
Route::post('/api/pemilih-potensial/update/{id}', [App\http\Controllers\PemilihPotensialController::class, 'update']);
Route::delete('/api/v2/pemilih-potensial/{idpemilihPotensial}', [App\Http\Controllers\PemilihPotensialController::class, 'destroy']);
// Route::get('/api/saksi/{id}', [App\Http\Controllers\SaksiController::class, 'show']);
Route::post('/api/saksi/search', [App\Http\Controllers\SaksiController::class, 'search']);
Route::post('/api/saksi', [App\Http\Controllers\SaksiController::class, 'store']);
Route::post('/api/saksi/update/{id}', [App\Http\Controllers\SaksiController::class, 'update']);
Route::delete('/api/saksi/delete/{id}', [App\Http\Controllers\SaksiController::class, 'delete']);

Route::get('/api/pemetaan-c1-provinsi/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Provinsi']);
Route::get('/api/pemetaan-c1-kabupaten/{idProvinsi}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Kabupaten']);
Route::get('/api/pemetaan-c1-kecamatan/{idKabupaten}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Kecamatan']);
Route::get('/api/pemetaan-c1-kelurahan/{idKecamatan}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1Kelurahan']);
Route::get('/api/pemetaan-c1-TPS/{idKelurahan}/{idPaslon}', [\App\Http\Controllers\PemetaanC1Controller::class, 'C1TPS']);

Route::post('/api/v2/registerpaslon', [App\Http\Controllers\PaslonController::class, 'store']);
Route::post('/api/v2/uploadc1/{idSaksi}', [\App\Http\Controllers\UploadC1Controller::class, 'UploadC1']);
//routetambahan
// Route::get('/api/pemetaanPROV/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemetaanSuaraProvinsi']);
// Route::get('/api/pemetaanKAB/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemetaanSuaraKabupaten']);
// Route::get('/api/pemetaanKEC/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemetaanSuaraKecamatan']);
// Route::get('/api/pemetaanKEL/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemetaanSuaraKelurahan']);

Route::get('/api/pemetaanSuara-provinsi/{idPaslon}', [App\Http\Controllers\PemetaanSuaraController::class, 'pemataanSuaraProvinsi']);
Route::get('/api/pemetaanSuara-kabupaten/{idProvinsi}/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemilihpotensialKabupaten']);
Route::get('/api/pemetaanSuara-kecamatan/{idKabupaten}/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemilihpotensialKecamataan']);
Route::get('/api/pemetaanSuara-kelurahan/{idKecamatan}/{idPaslon}', [\App\Http\Controllers\PemetaanSuaraController::class, 'pemilihpotensialKelurahan']);
