<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PangkatController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\golonganController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PetinggiDashboardController;
use App\Http\Controllers\Admin\PetinggiYLPIController;
use App\Http\Controllers\Admin\StaffAdministratorController;
use App\Http\Controllers\Petinggi\FromPetinggiDosenController;
use App\Http\Controllers\Petinggi\FromPetinggiPegawaiController;

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



Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth:staff-admin', 'revalidate'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // Route::get('/staff-admin', [StaffAdministratorController::class, 'index'])->name('data-admin');


        Route::resource('/profile-admin', '\App\Http\Controllers\Admin\ProfileAdminController');
        // Route::get('/grafik', [GrafikController::class, 'grafik'])->name('grafik');
        Route::resource('/dosen', '\App\Http\Controllers\Admin\DosenController');
        Route::get('/dataDosen', [DosenController::class, 'readDataDosen'])->name('read.dosen');
        Route::post('/deleteDosen', [DosenController::class, 'deleteDosen'])->name('delete.dosen');
        Route::post('/getDosenDetails', [DosenController::class, 'getDosenDetails'])->name('get.dosen.details');
        Route::post('/getGolonganFromPangkatDosen', [DosenController::class, 'getGolonganFromPangkatDosen'])->name('get.golongan.from.pangkat.dosen');

        Route::post('/getJurusanFromFakultas', [DosenController::class, 'getJurusanFromFakultas'])->name('get.jurusan.from.fakultas');
        Route::post('/updateDosenDetails', [DosenController::class, 'updateDosenDetails'])->name('update.dosen.details');
        Route::resource('/jurusan', '\App\Http\Controllers\Admin\JurusanController');
        Route::post('/getJurusanDetails', [JurusanController::class, 'getJurusanDetails'])->name('get.jurusan.details');
        Route::post('/updateJurusanDetails', [JurusanController::class, 'updateJurusanDetails'])->name('update.jurusan.details');

        Route::post('/deleteJurusan', [JurusanController::class, 'deleteJurusan'])->name('delete.jurusan');
        Route::resource('/fakultas', '\App\Http\Controllers\Admin\FakultasController');
        Route::post('/getFakultasDetails', [FakultasController::class, 'getFakultasDetails'])->name('get.fakultas.details');
        Route::post('/updateFakultasDetails', [FakultasController::class, 'updateFakultasDetails'])->name('update.fakultas.details');
        Route::post('/deleteFakultas', [FakultasController::class, 'deleteFakultas'])->name('delete.fakultas');

        Route::resource('/pegawai', '\App\Http\Controllers\Admin\PegawaiController');
        Route::get('/dataPegawai', [PegawaiController::class, 'readDataPegawai'])->name('read.pegawai');
        // Route::get('/getPegawai', [PegawaiController::class, 'getDataPegawai'])->name('get.pegawai.index');
        Route::post('/getPegawaiDetails', [PegawaiController::class, 'getPegawaiDetails'])->name('get.pegawai.details');
        // Route::get('/getPegawaiGrafik', [PegawaiController::class, 'grafik'])->name('get.pegawai.grafik');
        Route::post('/updatePegawaiDetails', [PegawaiController::class, 'updatePegawaiDetails'])->name('update.pegawai.details');
        Route::post('/getPangkatFromJabatan', [PegawaiController::class, 'getPangkatFromJabatan'])->name('get.pangkat.from.jabatan');
        Route::post('/getGolonganFromPangkat', [PegawaiController::class, 'getGolonganFromPangkat'])->name('get.golongan.from.pangkat');
        Route::post('/deletePegawai', [PegawaiController::class, 'deletePegawai'])->name('delete.pegawai');

        Route::resource('/petinggiYLPI', '\App\Http\Controllers\Admin\PetinggiYLPIController');
        Route::post('/getPetinggiDetails', [PetinggiYLPIController::class, 'getPetinggiDetails'])->name('get.petinggi.details');
        Route::post('/updatePetinggiDetails', [PetinggiYLPIController::class, 'updatePetinggiDetails'])->name('update.petinggi.details');
        Route::post('/deletePetinggi', [PetinggiYLPIController::class, 'deletePetinggi'])->name('delete.petinggi');
        Route::resource('/golongan', '\App\Http\Controllers\Admin\golonganController');
        Route::resource('/pangkat', '\App\Http\Controllers\Admin\PangkatController');
        Route::post('/deletePangkat', [PangkatController::class, 'deletePangkat'])->name('delete.pangkat');
        Route::post('/getPangkatDetails', [PangkatController::class, 'getPangkatDetails'])->name('get.pangkat.details');
        Route::post('/updatePangkatDetails', [PangkatController::class, 'updatePangkatDetails'])->name('update.pangkat.details');

        Route::resource('/jabatan', '\App\Http\Controllers\Admin\JabatanController');
        Route::get('/jabatan-getGolongan', [JabatanController::class, 'getGolonganJabatan'])->name('get.golongan.jabatan');
        Route::post('/updateJabatanDetails', [JabatanController::class, 'updateJabatanDetails'])->name('update.jabatan.details');
        Route::post('/getJabatanDetails', [JabatanController::class, 'getJabatanDetails'])->name('get.jabatan.details');
        Route::post('/deleteJabatan', [JabatanController::class, 'deleteJabatan'])->name('delete.jabatan');
        Route::post('/getGolonganDetails', [golonganController::class, 'getGolonganDetails'])->name('get.golongan.details');
        Route::post('/updateGolonganDetails', [golonganController::class, 'updateGolonganDetails'])->name('update.golongan.details');
        Route::post('/deleteGolongan', [golonganController::class, 'deleteGolongan'])->name('delete.golongan');
        Route::get('/pegawai-report', [PegawaiController::class, 'pegawaiReport'])->name('report.pegawai');
        Route::get('/pegawai-report/pdf/{daterange}', [PegawaiController::class, 'pegawaiReportPdf'])->name('report.pegawai_pdf');
        Route::get('/dosen-report', [DosenController::class, 'dosenReport'])->name('report.dosen');
        Route::get('/dosen-report/pdf/{daterange}', [DosenController::class, 'dosenReportPdf'])->name('report.dosen_pdf');


        // Route::group(['prefix' => 'reports'], function () {
        //     Route::get('/pegawai', [PegawaiController::class, 'pegawaiReport'])->name('laporan.pegawai');

        //     Route::get('/pegawai/pdf/{daterange}', [PegawaiController::class, 'pegawaiReportPdf'])->name('report.pegawai_pdf');

        //     // [.. ROUTING LAINNYA ..]
        // });
    });

Route::prefix('super-admin')
    ->namespace('Super-Admin')
    ->middleware(['auth:staff-admin', 'super-admin', 'revalidate'])
    ->group(function () {
        // Route::resource('/', '\App\Http\Controllers\SuperAdmin\DashboardSuperAdminController');
        // Route::get('/grafik', [GrafikController::class, 'grafik'])->name('grafik');
        Route::resource('/staff-admin', '\App\Http\Controllers\Admin\StaffAdministratorController')->middleware('super-admin');
        Route::post('/staff-admin-update', [StaffAdministratorController::class, 'updateStaff'])->name('update.staff');
    });


Route::prefix('petinggi')
    ->namespace('Petinggi')
    ->middleware(['auth:petinggi', 'revalidate'])
    ->group(function () {
        Route::get('/', [PetinggiDashboardController::class, 'index'])->name('dashboard-petinggi');
        Route::get('/welcome-petinggi', [PetinggiDashboardController::class, 'welcome'])->name('welcome-petinggi');
        Route::resource('/halaman-dosen-petinggi', '\App\Http\Controllers\Petinggi\FromPetinggiDosenController');
        Route::get('halaman-petinggi/data-dosen', [FromPetinggiDosenController::class, 'readDataDosenSectionPetinggi'])->name('petinggi.read.dosen');
        Route::get('halaman-petinggi/data-pegawai', [FromPetinggiPegawaiController::class, 'readDataPegawaiSectionPetinggi'])->name('petinggi.read.pegawai');

        Route::resource('/profile-petinggi', '\App\Http\Controllers\Petinggi\ProfilePetinggiController');
        Route::post('/notifPensiun/{nidn}', [FromPetinggiDosenController::class, 'notifPensiunDosen'])->name('send.notif.pensiun');
        Route::resource('/halaman-pegawai-petinggi', '\App\Http\Controllers\Petinggi\FromPetinggiPegawaiController');
        Route::post('/notifPensiunPegawai/{npk}', [FromPetinggiPegawaiController::class, 'notifPensiunPegawai'])->name('send.notif.pensiun.pegawai');
        Route::post('/notifPangkatPegawai/{npk}', [FromPetinggiPegawaiController::class, 'notifPangkatPegawai'])->name('send.notif.pangkat.pegawai');
    });



Route::get('/', [HomePageController::class, 'index'])->name('homepage')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);