<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\ActivityLogController;
use App\Http\Controllers\Admin\Apotek\{ObatController, OrderController, AntrianApotekController};
use App\Http\Controllers\Admin\{
    DashboardController,
    LayananController,
    PendaftaranController,
    UserController,
    LabController,
    KasirController,
    RadiologiController
};
use App\Http\Controllers\Admin\Dokter\PasienDokterController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/data', [PasienDokterController::class, 'q']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profil-saya', [UserController::class, 'show'])->name('user.profile');
});
// Role super admin
Route::group(['middleware' => ['auth', 'role:super_admin|apotek|dokter|poli|pendaftaran']], function () {


    Route::post('/layanan/data', [LayananController::class, 'data'])
        ->name('layanan.data');
    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');
    Route::get('/layanan/fetch-data', [LayananController::class, 'fetchData'])
        ->name('layanan.fetchData');
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');

    Route::get('/aktifitas-user', [ActivityLogController::class, 'index'])
        ->name('aktifitas-user.index');
    Route::get('/aktifitas-user/fetch-data', [ActivityLogController::class, 'fetchData'])
        ->name('aktifitas-user.fetchData');


    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('pendaftaran.index');
    Route::get('/pendaftaran/fetch-data', [PendaftaranController::class, 'fetchData'])
        ->name('pendaftaran.fetchData');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])
        ->name('pendaftaran.create');
    Route::get('/pendaftaran/dokter-poli', [PendaftaranController::class, 'getDokterPoli'])
        ->name('pendaftaran.dokter-poli');
    Route::get('/pendaftaran/create-pasien-terdaftar', [PendaftaranController::class, 'createPasienSudahPernahDaftar'])
        ->name('pendaftaran.createPasienSudahPernahDaftar');
    Route::get('/pendaftaran/cari-pasien', [PendaftaranController::class, 'searchPasien'])
        ->name('pendaftaran.search-pasien');
    Route::get('/pendaftaran/change-pasien', [PendaftaranController::class, 'changePasien'])
        ->name('pendaftaran.change-pasien');


    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');
    Route::post('/pendaftaran/create-pasien-terdaftar', [PendaftaranController::class, 'storePasienSudahPernahDaftar'])
        ->name('pendaftaran.storePasienSudahPernahDaftar');

    Route::get('/user/data', [UserController::class, 'index'])
        ->name('data.user');
    Route::get('/user/fetch-data', [UserController::class, 'fetchData'])
        ->name('user.fetchData');
    Route::get('/user/create', [UserController::class, 'createUser'])
        ->name('user.create');
    Route::post('/user/store', [UserController::class, 'storeUser'])
        ->name('user.store');
});

// Role dokter
Route::group(['middleware' => ['auth', 'role:dokter|super_admin']], function () {
    Route::get('/dokter/daftar-pasien', [PasienDokterController::class, 'index'])
        ->name('dokter.daftar-pasien');
    Route::get('/dokter/daftar-pasien/fetch', [PasienDokterController::class, 'fetch'])
        ->name('dokter.daftar-pasien.fetch');
    Route::get('/dokter/periksa-pasien/{id}', [PasienDokterController::class, 'periksaPasien'])
        ->name('dokter-spesialis.periksa-pasien');
    Route::get('/dokter/search-obat', [PasienDokterController::class, 'searchObat'])
        ->name('dokter.search-obat');
    Route::post('/dokter/change-obat', [PasienDokterController::class, 'changeObat'])
        ->name('dokter.change-obat');
    Route::get('/dokter/obat-pasien/{id}', [PasienDokterController::class, 'obatPasien'])
        ->name('dokter.obat-pasien');
    Route::put('/dokter/obat-pasien/update-quantity/{id}', [PasienDokterController::class, 'updateQuantity'])
        ->name('dokter.obat-pasien.update-quantity');
});

// Role apotek
Route::group(['middleware' => ['auth', 'role:apotek']], function () {
    // Data obat
    Route::get('/obat', [ObatController::class, 'dataObat'])->name('data');
    Route::get('/obat/fetch-data', [ObatController::class, '_fetchData'])->name('obat.fetchData');
    Route::get('/create', [OrderController::class, 'createObat'])->name('order.create-obat');
    Route::post('/create', [OrderController::class, 'storeObat'])->name('order.store.obat');

    // Daftar antrian
    Route::get('/antrian', [AntrianApotekController::class, 'index'])->name('data.antrian');
});

// Role poli
Route::group(['middleware' => ['auth', 'role:poli']], function () {
});

Route::group(['middleware' => ['auth', 'role:apotek']], function () {

    Route::get('/obat', [ObatController::class, 'dataObat'])->name('data');
    Route::get('/obat/fetch-data', [ObatController::class, 'fetchData'])->name('obat.fetchData');
    Route::get('/create', [OrderController::class, 'createObat'])->name('order.create-obat');
    Route::post('/create', [OrderController::class, 'storeObat'])->name('order.store.obat');
});

Route::group(['middleware' => ['auth', 'role:kasir|super_admin']], function () {

    Route::get('/bpjs', [KasirController::class, 'kasir_bpjs'])
        ->name('kasir.bpjs');
    Route::get('/umum', [KasirController::class, 'kasir_umum'])
        ->name('kasir.umum');
    Route::get('/otc', [KasirController::class, 'kasir_otc'])
        ->name('kasir.otc');

    Route::get('/aktifitas-user', [ActivityLogController::class, 'index'])
        ->name('aktifitas-user.index');
    Route::get('/aktifitas-user/fetch-data', [ActivityLogController::class, 'fetchData'])
        ->name('aktifitas-user.fetchData');
});

Route::group(['middleware' => ['auth', 'role: lab|super_admin']], function () {


    Route::get('/otclab', [LabController::class, 'lab_otc'])
        ->name('lab.otc');
    Route::get('/umumlab', [LabController::class, 'lab_umum'])
        ->name('lab.umum');

    Route::get('/aktifitas-user', [ActivityLogController::class, 'index'])
        ->name('aktifitas-user.index');
    Route::get('/aktifitas-user/fetch-data', [ActivityLogController::class, 'fetchData'])
        ->name('aktifitas-user.fetchData');
});

Route::group(['middleware' => ['auth', 'role:radiologi|super_admin']], function () {


    Route::get('/otcradio', [RadiologiController::class, 'radiologi_otc'])
        ->name('order.radiologi-otc');
    Route::post('/create', [RadiologiController::class, 'radiologi_rs'])
        ->name('order.radiologi-rs');
    Route::get('/aktifitas-user', [ActivityLogController::class, 'index'])
        ->name('aktifitas-user.index');
    Route::get('/aktifitas-user/fetch-data', [ActivityLogController::class, 'fetchData'])
        ->name('aktifitas-user.fetchData');
});


Route::group(['middleware' => ['auth', 'role:dokter|super_admin']], function () {

    Route::post('/layanan/data', [LayananController::class, 'data'])
        ->name('layanan.data');
    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');
    Route::get('/layanan/fetch-data', [LayananController::class, 'fetchData'])
        ->name('layanan.fetchData');
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');
});

Route::group(['middleware' => ['auth', 'role:admin|super_admin']], function () {

    Route::post('/layanan/data', [LayananController::class, 'data'])
        ->name('layanan.data');
    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');
    Route::get('/layanan/fetch-data', [LayananController::class, 'fetchData'])
        ->name('layanan.fetchData');
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');
});

Route::group(['middleware' => ['auth', 'role:poli|super_admin']], function () {

    Route::post('/layanan/data', [LayananController::class, 'data'])
        ->name('layanan.data');
    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');
    Route::get('/layanan/fetch-data', [LayananController::class, 'fetchData'])
        ->name('layanan.fetchData');
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');
});

Route::get('/pasien-list', [PasienController::class, 'data_pasien'])->name('list.pasien');
Route::post('/pasien-store', [PasienController::class, 'store'])->name('store.pasien');

require __DIR__ . '/auth.php';
