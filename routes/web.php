<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

//route terlarang untuk akses langsung, dikembalikan ke halaman utama
Route::get('/store', function(){
    return redirect('/');
});
Route::get('/cari-unit-kerja', function(){
    return redirect('/');
});
Route::get('/_ignition/share-report', function(){
    return redirect('/');
});
Route::get('/cari-nama-pemohon', function(){
    return redirect('/');
});
Route::get('/cari-nama-pejabat', function(){
    return redirect('/');
});

//route form input & store
Route::get('/', [FormController::class, 'index']);
Route::post('store', [FormController::class, 'store']);

//route tabel rekap permintaan
Route::get('tabel-permintaan', [FormController::class, 'tabelPermintaan'])->name('tabel-permintaan');
Route::get('/tabel-permintaan/lihat-keterangan-gagal/{id}', [FormController::class, 'modalLihatKeterangan']);

//route statistik frontend
Route::get('statistik', [FormController::class, 'statistik'])->name('statistik');

//route video tutorial
Route::get('tutorial', [FormController::class, 'videoTutorial']);

//route autocomplete
Route::post('cari-nama-pemohon', [FormController::class, 'searchPemohon'])->name('cari-nama-pemohon');
Route::post('cari-nama-pejabat', [FormController::class, 'searchPejabat'])->name('cari-nama-pejabat');
Route::post('cari-unit-kerja', [FormController::class, 'searchUnitKerja'])->name('cari-unit-kerja');

/********************************************ADMIN ROUTES**************************************************************/

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

//route admin
Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
Route::post('admin/dashboard/filter-data', [DashboardController::class, 'filterData']);
Route::get('admin/permintaan', [AdminController::class, 'tabelPermintaan'])->name('tabel-permintaan-admin');
Route::get('admin/permintaan/cetak/{permintaan}', [AdminController::class, 'printPDF']); //route print pdf
Route::get('admin/permintaan/lihat/{permintaan}', [AdminController::class, 'lihatFormulir']); //route lihat formulir
Route::put('admin/permintaan/proses/{permintaan}', [AdminController::class, 'prosesPermintaan']); //route proses permintaan
Route::get('admin/permintaan/lihat/{permintaan}/modal-blokir', [AdminController::class, 'modalBlokirDokumen']); //route modal blokir dokumen
Route::put('admin/permintaan/lihat/{permintaan}/blokir/{standar}', [AdminController::class, 'blokirDokumen']); //route blokir dokumen
Route::get('admin/standar/sni', [AdminController::class, 'sniView']);
Route::get('admin/standar/astm', [AdminController::class, 'astmView']);
Route::get('admin/standar/iec', [AdminController::class, 'iecView']);
Route::get('admin/standar/iso', [AdminController::class, 'isoView']);
Route::get('admin/standar/lainnya', [AdminController::class, 'lainnyaView']);
Route::get('admin/unit-kerja/sestama', [AdminController::class, 'sestamaView']);
Route::get('admin/unit-kerja/pengembangan', [AdminController::class, 'pengembanganView']);
Route::get('admin/unit-kerja/penerapan', [AdminController::class, 'penerapanView']);
Route::get('admin/unit-kerja/akreditasi', [AdminController::class, 'akreditasiView']);
Route::get('admin/unit-kerja/snsu', [AdminController::class, 'snsuView']);
Route::get('admin/unit-kerja/klt', [AdminController::class, 'kltView']);
Route::get('admin/data-master/data-pengelola', [UserController::class, 'dataPengelolaView']);
Route::patch('admin/data-master/data-pengelola', [UserController::class, 'updatePengelola'])->name('data-pengelola.update');
Route::get('admin/data-master/data-pegawai', [AdminController::class, 'dataPegawaiView']);
Route::post('admin/data-master/data-pegawai', [AdminController::class, 'tambahPegawai']);
Route::get('admin/data-master/data-pegawai/edit-pegawai/{id}', [AdminController::class, 'editPegawai']);
Route::put('admin/data-master/data-pegawai/update-pegawai/{id}', [AdminController::class, 'updatePegawai']);
Route::delete('admin/data-master/data-pegawai/hapus-pegawai/{id}', [AdminController::class, 'deletePegawai']);
Route::get('admin/data-master/tujuan-penggunaan', [AdminController::class, 'tujuanPenggunaanView']);
Route::get('admin/dokumen-tidak-tersedia', [AdminController::class, 'dokumenTidakTersedia']);
