<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\ActivityLogController;
use App\Http\Controllers\Admin\Apotek\{
    ObatController,
    OrderController,
    AntrianBpjsController,
    AntrianUmumController,
    Select2Controller,
    LaporanController
};
use App\Http\Controllers\Admin\Dokter\{PasienDokterController, DokterController};
use App\Http\Controllers\Admin\{
    DashboardController,
    LayananController,
    UserController,
    LabController,
    KasirController,
    RadiologiController,
    PoliStationController,
    PosisiPasienController,
    AntrianPoliController,
    AsuransiController
};
use App\Http\Controllers\Admin\NurseStation\{NurseStationController};
use App\Http\Controllers\Admin\Pendaftaran\{
    RawatJalanController as PendaftaranRawatJalanController,
    RawatInapController as PendaftaranRawatInapController
};
use App\Http\Controllers\Auth\UserDetailController;
use App\Http\Controllers\Frontend\PersetujuanController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/informasi/persetujuan-pasien', [PersetujuanController::class, 'index'])
    ->name('informasi.persetujuan-pasien');

// Role super admin
Route::group(['middleware' => ['auth', 'role:super_admin|apotek|dokter|poli|rekam_medis']], function () {
    Route::post('/layanan/data', [LayananController::class, 'data'])
        ->name('layanan.data');
    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');
    Route::get('/layanan/fetch-data', [LayananController::class, 'fetchData'])
        ->name('layanan.fetchData');
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    Route::get('/antrian-pasien/poli-jantung', [AntrianPoliController::class, 'antrianPoliJantung'])
        ->name('dashboard.antrian-poli.jantung');
    Route::get('/antrian-pasien/poli-jantung/data', [AntrianPoliController::class, 'dataAntrianPoliJantung'])
        ->name('dashboard.antrian-poli.jantung.data');
    Route::get('/antrian-pasien/poli-anak', [AntrianPoliController::class, 'antrianPoliAnak'])
        ->name('dashboard.antrian-poli.anak');
});

// Role super admin | pendaftaran
Route::group(['middleware' => ['auth', 'role:super_admin|pendaftaran']], function () {
    // Pendaftaran Rawat Jalan
    Route::get('/pendaftaran/rawat-jalan', [PendaftaranRawatJalanController::class, 'index'])
        ->name('pendaftaran.rawat-jalan.index');
    Route::get('/pendaftaran/rawat-jalan/fetch-data', [PendaftaranRawatJalanController::class, 'fetchData'])
        ->name('pendaftaran.rawat-jalan.fetchData');
    Route::get('/pendaftaran/rawat-jalan/create', [PendaftaranRawatJalanController::class, 'create'])
        ->name('pendaftaran.rawat-jalan.create');
    Route::get('/pendaftaran/rawat-jalan/dokter-poli', [PendaftaranRawatJalanController::class, 'getDokterPoli'])
        ->name('pendaftaran.rawat-jalan.dokter-poli');
    Route::get('/pendaftaran/rawat-jalan/create-pasien-terdaftar', [PendaftaranRawatJalanController::class, 'createPasienSudahPernahDaftar'])
        ->name('pendaftaran.rawat-jalan.createPasienSudahPernahDaftar');
    Route::get('/pendaftaran/rawat-jalan/cari-pasien', [PendaftaranRawatJalanController::class, 'searchPasien'])
        ->name('pendaftaran.rawat-jalan.search-pasien');
    Route::get('/pendaftaran/rawat-jalan/change-pasien', [PendaftaranRawatJalanController::class, 'changePasien'])
        ->name('pendaftaran.rawat-jalan.change-pasien');
    Route::post('/pendaftaran/rawat-jalan', [PendaftaranRawatJalanController::class, 'store'])
        ->name('pendaftaran.rawat-jalan.store');
    Route::post('/pendaftaran/rawat-jalan/create-pasien-terdaftar', [PendaftaranRawatJalanController::class, 'storePasienSudahPernahDaftar'])
        ->name('pendaftaran.rawat-jalan.storePasienSudahPernahDaftar');
    Route::delete('/pendaftaran/rawat-jalan/pasien/{pemeriksaan}/delete', [PendaftaranRawatJalanController::class, 'destroy'])
        ->name('pendaftaran.rawat-jalan.destroy');
    // End

    // Posisi pasien rajal
    Route::get('/pendaftaran/rawat-jalan/{id}/posisi-pasien', [PosisiPasienController::class, 'rajal'])
        ->name('posisi-pasien.rajal');
    // End

    // Pendaftaran Rawat Inap
    Route::get('/pendaftaran/rawat-inap', [PendaftaranRawatInapController::class, 'index'])
        ->name('pendaftaran.rawat-inap.index');
    Route::get('/pendaftaran/rawat-inap/fetch-data', [PendaftaranRawatInapController::class, 'fetchData'])
        ->name('pendaftaran.rawat-inap.fetchData');
    Route::get('/pendaftaran/rawat-inap/create', [PendaftaranRawatInapController::class, 'create'])
        ->name('pendaftaran.rawat-inap.create');
    Route::get('/pendaftaran/rawat-inap/nurse-station', [PendaftaranRawatInapController::class, 'getNurseStation'])
        ->name('pendaftaran.rawat-inap.nurse-station');
    Route::post('/pendaftaran/rawat-inap', [PendaftaranRawatInapController::class, 'store'])
        ->name('pendaftaran.rawat-inap.store');
    Route::get('/pendaftaran/rawat-inap/create-pasien-terdaftar', [PendaftaranRawatInapController::class, 'createPasienSudahPernahDaftar'])
        ->name('pendaftaran.rawat-inap.createPasienSudahPernahDaftar');


    // Posisi pasien ranap
    Route::get('/pendaftaran/rawat-inap/{id}/posisi-pasien', [PosisiPasienController::class, 'ranap'])
        ->name('posisi-pasien.ranap');
    // End


    // Asuransi
    Route::post('/asuransi', [AsuransiController::class, 'store'])
        ->name('asuransi.store');
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
    Route::delete('/dokter/hapus-obat/{id}', [PasienDokterController::class, 'hapusObat'])
        ->name('dokter.obat-pasien.hapus');
    Route::put('/dokter/daftar-pasien/{periksaDokter}', [PasienDokterController::class, 'storePasien'])
        ->name('dokter.store-pasien');
    Route::put('/dokter/obat-pasien/signa-1/{id}', [PasienDokterController::class, 'signa1'])
        ->name('dokter.obat-pasien.signa1');
    Route::put('/dokter/obat-pasien/signa-2/{id}', [PasienDokterController::class, 'signa2'])
        ->name('dokter.obat-pasien.signa2');

    // Diagnosa
    Route::get('/dokter/search-diagnosa', [PasienDokterController::class, 'searchDiagnosa'])
        ->name('dokter.search-diagnosa');
    Route::get('/dokter/diagnosa-pasien/{id}', [PasienDokterController::class, 'diagnosaPasien'])
        ->name('dokter.diagnosa-pasien');
    Route::post('/dokter/change-diagnosa', [PasienDokterController::class, 'changeDiagnosa'])
        ->name('dokter.change-diagnosa');
    Route::delete('/dokter/hapus-diagnosa/{diagnosaPasienRajal}', [PasienDokterController::class, 'hapusDiagnosa'])
        ->name('dokter.diagnosa-pasien.hapus');
    Route::put('/dokter/diagnosa-pasien/{diagnosaPasienRajal}', [PasienDokterController::class, 'diagnosaBagian'])
        ->name('dokter.diagnosa-pasien.bagian');

    // Tindakan
    Route::get('/dokter/search-tindakan', [PasienDokterController::class, 'searchTindakan'])
        ->name('dokter.search-tindakan');
    Route::get('/dokter/tindakan-pasien/{id}', [PasienDokterController::class, 'tindakanPasien'])
        ->name('dokter.tindakan-pasien');
    Route::post('/dokter/change-tindakan', [PasienDokterController::class, 'changeTindakan'])
        ->name('dokter.change-tindakan');
    Route::delete('/dokter/hapus-tindakan/{tindakanPasienRajal}', [PasienDokterController::class, 'hapustindakan'])
        ->name('dokter.tindakan-pasien.hapus');
    Route::put('/dokter/tindakan-pasien/{tindakanPasienRajal}', [PasienDokterController::class, 'tindakanBagian'])
        ->name('dokter.tindakan-pasien.bagian');
});

// Role apotek
Route::group(['middleware' => ['auth', 'role:apotek|super_admin']], function () {
    // Data obat
    Route::get('/obat', [ObatController::class, 'dataObat'])->name('data');
    Route::get('/obat/fetch-data', [ObatController::class, '_fetchData'])->name('obat.fetchData');
    Route::get('/obat/create', [OrderController::class, 'createObat'])->name('order.create-obat');
    Route::post('/obat/store/obat', [OrderController::class, 'storeObat']);

    // Daftar antrian bpjs
    Route::get('/apotek/bpjs', [AntrianBpjsController::class, 'index'])->name('data.antrian.bpjs');
    Route::get('/apotek/fetch-data', [AntrianBpjsController::class, '_fetchData'])->name('data.antrian');
    Route::get('/apotek/detail/pasien/{id}', [AntrianBpjsController::class, 'detailPasienBpjs'])
        ->name('apotek.pasien-bpjs');
    Route::get('/apotek/proses/data/{pemeriksaan_id}/{periksa_dokter_id}', [AntrianBpjsController::class, 'obatApotek'])
        ->name('apotek.proses-pasien');
    Route::post('/apotek/proses/pasien/{id}/update', [AntrianBpjsController::class, 'prosesPasienBpjs'])
        ->name('apotek.pasien-bpjs-update');
    Route::get('/apotek/preview/{pemeriksaan_id}/pdf/{periksa_dokter_id}', [AntrianBpjsController::class, 'previewPDF'])
        ->name('apotek.preview-hasil');

    // Laporan riwayat obat pasien
    Route::get('/apotek/laporan', [LaporanController::class, 'laporanApotek'])
        ->name('apotek.laporan');
    Route::post('/apotek/laporan/ekspor', [LaporanController::class, 'ekspor'])
        ->name('apotek.ekspor');

    // Daftar antrian umum
    Route::get('/apotek/data-umum', [AntrianUmumController::class, 'umum'])->name('data.umum');
    Route::get('/apotek/fetch/umum', [AntrianUmumController::class, '_fetchUmum'])->name('fetch-umum');
    Route::get('/apotek/pasien/umum/{id}', [AntrianUmumController::class, 'detailPasienUmum'])
        ->name('pasien-umum');
    Route::get('/apotek/umum/{pemeriksaan_id}/proses/{periksa_dokter_id}', [AntrianUmumController::class, 'pasienUmum'])
        ->name('apotek.pasien-umum');
    Route::post('/apotek/proses/pasien/umum/{id}/update', [AntrianUmumController::class, 'prosesPasienUmum'])
        ->name('apotek.pasien-umum-update');
    // Route::get('/apotek/preview/{pemeriksaan_id}/pdf/{periksa_dokter_id}', [AntrianUmumController::class, 'previewPDF'])
    //     ->name('apotek.preview-umum');
    // Route::get('/create/apotek', [AntrianBpjsController::class, 'createApotek'])->name('create.antrian');
    // Route::post('/store/apotek', [AntrianBpjsController::class, 'storeApotek'])->name('store.antrian');
    // Route::post('/apotek/{id}/update/', [AntrianBpjsController::class, 'updateApotek'])->name('update.antrian');

    // Daftar antrian umum
    Route::get('/apotek/data-asuransi', [AntrianUmumController::class, 'asuransi'])->name('data.asuransi');

    // Search obat
    Route::get('/search-obat-apotek', [Select2Controller::class, 'searchObat'])->name('search.obat-apotek');
});

// Role poli
Route::group(['middleware' => ['auth', 'role:poli_station|super_admin']], function () {
    Route::get('/poli-station', [PoliStationController::class, 'index'])
        ->name('poli-station.index');
    Route::get('/poli-station/fetch-data', [PoliStationController::class, 'fetchData'])
        ->name('poli-station.fetchData');
    Route::get('/poli-station/{periksaPoliStation}/detail', [PoliStationController::class, 'show'])
        ->name('poli-station.detail-pasien');
    Route::post('/poli-station/{pemeriksaan}/periksa', [PoliStationController::class, 'periksa'])
        ->name('poli-station.periksa');
    Route::put('/poli-station/{periksaPoliStation}/update', [PoliStationController::class, 'update'])
        ->name('poli-station.update');
});

// Kasir
Route::group(['middleware' => ['auth', 'role:kasir|super_admin']], function () {
    Route::get('/kasir', [KasirController::class, 'index'])
        ->name('kasir.index');
    Route::get('/kasir/fetch-data', [KasirController::class, 'fetch'])
        ->name('kasir.fetch');
    Route::get('/kasir/{kasir}/detail', [KasirController::class, 'detail'])
        ->name('kasir.detail');
    Route::get('/kasir/{kasir}/proses', [KasirController::class, 'proses'])
        ->name('kasir.proses');
    Route::get('/kasir/{kasir}/print-invoice', [KasirController::class, 'printInvoice'])
        ->name('kasir.print-invoice');
    Route::get('/kasir/laporan', [KasirController::class, 'laporan'])
        ->name('kasir.laporan');
    Route::put('/kasir/{kasir}/update-tagihan', [KasirController::class, 'updateTagihan'])
        ->name('kasir.update-tagihan');
    Route::put('/kasir/{kasir}/update-status', [KasirController::class, 'updateStatus'])
        ->name('kasir.update-status');
    Route::put('/kasir/{kasir}/tambah-deposit', [KasirController::class, 'tambahDeposit'])
        ->name('kasir.tambah-deposit');
    Route::post('/kasir/laporan/ekspor', [KasirController::class, 'ekspor'])
        ->name('kasir.laporan.ekspor');
});

Route::group(['middleware' => ['auth', 'role: lab|super_admin']], function () {
    Route::get('/otclab', [LabController::class, 'lab_otc'])
        ->name('lab.otc');
    Route::get('/umumlab', [LabController::class, 'lab_umum'])
        ->name('lab.umum');
});

Route::group(['middleware' => ['auth', 'role:pendaftaran|super_admin']], function () {

    Route::get('/data', [PendaftaranController::class, 'q']);
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('pendaftaran.index');
    Route::get('/pendaftaran/fetch-data', [PendaftaranController::class, 'fetchData'])
        ->name('pendaftaran.fetchData');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])
        ->name('pendaftaran.create');
    Route::get('/pendaftaran/create-pasien-terdaftar', [PendaftaranController::class, 'createPasienTerdaftar'])
        ->name('pendaftaran.create.pasien-terdaftar');
    Route::get('/pendaftaran/dokter-poli', [PendaftaranController::class, 'getDokterPoli'])
        ->name('pendaftaran.dokter-poli');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');
    Route::get('/messanger', [PendaftaranController::class, 'messanger'])
        ->name('pendaftaran.messanger');
    Route::get('/pendaftaran/create-pasien-terdaftar', [PendaftaranController::class, 'createPasienSudahPernahDaftar'])
        ->name('pendaftaran.createPasienSudahPernahDaftar');
    Route::get('/antrian', [PendaftaranController::class, 'antrian'])
        ->name('pendaftaran.antrian');
    Route::get('/loket', [PendaftaranController::class, 'loket'])
        ->name('pendaftaran.loket');

    Route::get('/generate-antrian', [AntrianController::class, 'generate'])
        ->name('antrian.generate');
    Route::get('/generate/{nama}', [AntrianController::class, 'printAntrian'])
        ->name('antrian.print');
    Route::get('/panggil', [AntrianController::class, 'suara'])
        ->name('antrian.panggil');
    Route::get('/antrian-baru', [AntrianController::class, 'antrian_baru'])
        ->name('antrian.baru');
    Route::get('/ada-antrian', [AntrianController::class, 'ada_antrian'])
        ->name('/antrian.ada-antrian');
    Route::get('/tidak-ada', [AntrianController::class, 'tidak_ada_antrian'])
        ->name('antrian.tidakada');
});

Route::group(['middleware' => ['auth', 'role:radiologi|super_admin']], function () {
    Route::get('/otcradio', [RadiologiController::class, 'radiologi_otc'])
        ->name('order.radiologi-otc');
    Route::get('/umumradio', [RadiologiController::class, 'radiologi_umum'])
        ->name('order.radiologi-umum');
    Route::get('/aktifitas-user', [ActivityLogController::class, 'index'])
        ->name('aktifitas-user.index');
    Route::get('/aktifitas-user/fetch-data', [ActivityLogController::class, 'fetchData'])
        ->name('aktifitas-user.fetchData');
});


Route::group(['middleware' => ['auth', 'role:admin|super_admin']], function () {

    // dokter
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/fetch-data', [DokterController::class, 'fetchData'])->name('dokter.fetchData');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::get('/dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::get('/dokter/{dokter}/ganti-jadwal-praktek', [DokterController::class, 'gantiJadwal'])->name('dokter.ganti-jadwal-praktek');
    Route::put('/dokter/{dokter}/ganti-jadwal-praktek', [DokterController::class, 'updateJadwal'])->name('dokter.update-jadwal-praktek');
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::put('/dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{dokter}/delete', [DokterController::class, 'delete'])->name('dokter.delete');

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');
    Route::get('/user/fetch-data', [UserController::class, 'fetchData'])
        ->name('user.fetchData');
    Route::get('/user/create', [UserController::class, 'create'])
        ->name('user.create');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])
        ->name('user.edit');
    Route::post('/user/store', [UserController::class, 'store'])
        ->name('user.store');
    Route::put('/user/{user}/update-status', [UserController::class, 'updateStatus'])
        ->name('user.update-status');
    Route::put('/user/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('user.reset-password');
    Route::put('/user/{user}/update', [UserController::class, 'update'])
        ->name('user.update');
    Route::delete('/user/{user}/delete', [UserController::class, 'delete'])
        ->name('user.delete');

    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');
    Route::get('/layanan/fetch-data', [LayananController::class, 'fetchData'])
        ->name('layanan.fetchData');
    Route::get('/layanan/{layanan}', [LayananController::class, 'show'])
        ->name('layanan.show');
    Route::put('/layanan/{layanan}', [LayananController::class, 'update'])
        ->name('layanan.update');
    Route::delete('/layanan/{layanan}/delete', [LayananController::class, 'delete'])
        ->name('layanan.delete');
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');

    Route::get('/aktifitas-user', [ActivityLogController::class, 'index'])
        ->name('aktifitas-user.index');
    Route::get('/aktifitas-user/fetch-data', [ActivityLogController::class, 'fetchData'])
        ->name('aktifitas-user.fetchData');

    Route::get('/station', [NurseStationController::class, 'index'])
        ->name('nurse-station.index');
});

require __DIR__ . '/auth.php';
