<?php

use App\Http\Controllers\Admin\{BalasanKNKPL, BeritaAcaraController, DashboardController, KeputusanGubernurController, LaporanController, UsulanController, UsulanKNKPLControler};
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Nasabah\{GetNotifController, HomeController, StatusUsulanController, SuratBpkdController, UsulanNasabahController};
use App\Http\Controllers\PembayaranNasabahController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('cek.login');
Route::post('/login', [AuthController::class, 'login'])->name('cek.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('cek.logout');

// route admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/{id}', [DashboardController::class, 'getSkpdById']);

    // usulan admin
    Route::get('/usulan', [UsulanController::class, 'index']);
    Route::get('/usulan/{id}', [UsulanController::class, 'show']);
    Route::get('/usulan/next_2/{id}', [UsulanController::class, 'showNext2']);
    Route::get('/usulan/next_3/{id}', [UsulanController::class, 'showNext3']);
    Route::get('/usulan/next_4/{id}', [UsulanController::class, 'showNext4']);
    Route::get('/usulan/save/{id}', [UsulanController::class, 'save']);
    Route::get('/detail-usulan/{id}', [UsulanController::class, 'showUsulan']);

    Route::put('/usulan/next/{id}/update_1', [UsulanController::class, 'usulanUpdate_1']);
    Route::put('/usulan/next/{id}/update_2', [UsulanController::class, 'usulanUpdate_2']);
    Route::put('/usulan/next/{id}/update_3', [UsulanController::class, 'usulanUpdate_3']);
    Route::put('/usulan/next/{id}/update_4', [UsulanController::class, 'usulanUpdate_4']);
    Route::put('/usulan/{id}/save_update', [UsulanController::class, 'save_update']);

    // surat usulan knkpl
    Route::get('/usulan-knkpl', [UsulanKNKPLControler::class, 'index']);
    Route::post('/usulan-knkpl', [UsulanKNKPLControler::class, 'store']);

    // balasan knkpl
    Route::get('/balasan-knkpl', [BalasanKNKPL::class, 'index']);
    Route::post('/balasan-knkpl', [BalasanKNKPL::class, 'store']);

    // keputusan gubernur
    Route::get('/keputusan', [KeputusanGubernurController::class, 'index']);
    Route::post('/keputusan', [KeputusanGubernurController::class, 'store']);

    // berita acara
    Route::get('/berita-acara', [BeritaAcaraController::class, 'index']);
    Route::post('/berita-acara', [BeritaAcaraController::class, 'store']);

    // laporan
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/export', [LaporanController::class, 'export']);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak']);
});

// route nasabah
Route::group(['prefix' => 'nasabah'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    
    Route::get('/home/getUsulan/{id}', [HomeController::class, 'getUsulan']);
    Route::get('/home/usulan', [HomeController::class, 'usualan']);

    Route::post('/home/update/{id}', [HomeController::class, 'updateUsulan']);

    // usulan list
    Route::get('/usulan', [UsulanNasabahController::class, 'index']);
    Route::get('/usulan/surat/{id}', [UsulanNasabahController::class, 'suratUsulan']);
    Route::get('/usulan/surat/next/{id}', [UsulanNasabahController::class, 'nextUsulan']);
    Route::get('/usulan/surat/next3/{id}', [UsulanNasabahController::class, 'nextUsulan3']);
    Route::get('/usulan/surat/next4/{id}', [UsulanNasabahController::class, 'nextUsulan4']);
    Route::get('/usulan/surat/next5/{id}', [UsulanNasabahController::class, 'nextUsulan5']);

    Route::post('/usulan/surat', [UsulanNasabahController::class, 'storeUsulan']);
    Route::put('/usulan/surat/next2/{id}/update', [UsulanNasabahController::class, 'storeNext2'])->name('next2');
    Route::put('/usulan/surat/next3/{id}/update', [UsulanNasabahController::class, 'storeNext3']);
    Route::put('/usulan/surat/next4/{id}/update', [UsulanNasabahController::class, 'storeNext4']);
    Route::put('/usulan/surat/next5/{id}/save', [UsulanNasabahController::class, 'saveNext']);

    // surat bpkd nasabah
    Route::get('/surat-bpkd', [SuratBpkdController::class, 'index']);
    Route::post('/surat-bpkd', [SuratBpkdController::class, 'update']);

    // status usulan
    Route::get('/status-usulan', [StatusUsulanController::class, 'index']);
    Route::get('/status-usulan/dokumen/{id}', [StatusUsulanController::class, 'detail']);
    Route::put('/status-usulan/dokumen/{id}', [StatusUsulanController::class, 'update']);

    // pembayaran
    Route::get('/pembayaran', [PembayaranNasabahController::class, 'index']);
    Route::post('/pembayaran', [PembayaranNasabahController::class, 'store']);
});

// route get data json jQuery
Route::group(['prefix' => 'json'], function () {
    Route::post('/piutangs', [UsulanController::class, 'getPiutangs']);
    Route::post('/piutangsById', [UsulanKNKPLControler::class, 'getPiutangsById']);

    //usulan
    Route::get('/usulanById/{id}', [UsulanNasabahController::class, 'getUsulanById']);
    Route::get('/notif', [GetNotifController::class, 'getNotif']);
    Route::get('/notif/count', [GetNotifController::class, 'countNotif']);
    Route::get('/notif/{id}', [GetNotifController::class, 'cekNotif']);
});
