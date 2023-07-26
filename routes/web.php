<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\PasienController;

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

Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return view('login');
});
 
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/home', [HomeController::class, 'index'])->name('home-index');
Route::get('/user',[UserController::class, 'index'])->name('user');
Route::post('/post-user',[UserController::class, 'add'])->name('post-user');
Route::get('/get-user/{id}',[UserController::class, 'detail'])->name('get-user');
Route::get('/delete-user/{id}',[UserController::class, 'delete'])->name('delete-user');
Route::get('/activate-user/{id}',[UserController::class, 'activate'])->name('activate-user');
Route::get('/cek-mail',[UserController::class, 'cekEmail'])->name('cek-email');
Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi-index');
Route::get('/provinsi-list', [ProvinsiController::class, 'provinsiList'])->name('provinsi-list');
Route::post('/post-provinsi',[ProvinsiController::class, 'add'])->name('post-provinsi');
Route::get('/get-provinsi/{id}',[ProvinsiController::class, 'detail'])->name('get-provinsi');
Route::get('/delete-provinsi/{id}',[ProvinsiController::class, 'delete'])->name('delete-provinsi');
Route::get('/activate-provinsi/{id}',[ProvinsiController::class, 'activate'])->name('activate-provinsi');
Route::get('/detail-view-provinsi/{id}',[ProvinsiController::class, 'detailView'])->name('detail-view-provinsi');
Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten-index');
Route::get('/kabupaten-list/{id}', [KabupatenController::class, 'kabupatenList'])->name('kabupaten-list');
Route::post('/post-kabupaten',[KabupatenController::class, 'add'])->name('post-kabupaten');
Route::get('/get-kabupaten/{id}',[KabupatenController::class, 'detail'])->name('get-kabupaten');
Route::get('/delete-kabupaten/{id}',[KabupatenController::class, 'delete'])->name('delete-kabupaten');
Route::get('/activate-kabupaten/{id}',[KabupatenController::class, 'activate'])->name('activate-kabupaten');
Route::get('/detail-view-kabupaten/{id}',[KabupatenController::class, 'detailView'])->name('detail-view-kabupaten');
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan-index');
Route::get('/kecamatan-list/{id}', [KecamatanController::class, 'kecamatanList'])->name('kecamatan-list');
Route::post('/post-kecamatan',[KecamatanController::class, 'add'])->name('post-kecamatan');
Route::get('/get-kecamatan/{id}',[KecamatanController::class, 'detail'])->name('get-kecamatan');
Route::get('/delete-kecamatan/{id}',[KecamatanController::class, 'delete'])->name('delete-kecamatan');
Route::get('/activate-kecamatan/{id}',[KecamatanController::class, 'activate'])->name('activate-kecamatan');
Route::get('/detail-view-kecamatan/{id}',[KecamatanController::class, 'detailView'])->name('detail-view-kecamatan');
Route::get('/desa', [DesaController::class, 'index'])->name('desa-index');
Route::get('/desa-list/{id}', [DesaController::class, 'desaList'])->name('desa-list');
Route::post('/post-desa',[DesaController::class, 'add'])->name('post-desa');
Route::get('/get-desa/{id}',[DesaController::class, 'detail'])->name('get-desa');
Route::get('/delete-desa/{id}',[DesaController::class, 'delete'])->name('delete-desa');
Route::get('/activate-desa/{id}',[DesaController::class, 'activate'])->name('activate-desa');
Route::get('/detail-view-desa/{id}',[DesaController::class, 'detailView'])->name('detail-view-desa');
Route::get('/pasien',[PasienController::class, 'index'])->name('pasien-index');
Route::get('/pasien-add',[PasienController::class, 'addPasien'])->name('pasien-add');
Route::post('/post-pasien',[PasienController::class, 'add'])->name('post-pasien');
Route::get('/detail-pasien/{id}',[PasienController::class, 'detail'])->name('detail-pasien');
Route::get('/update-pasien/{id}',[PasienController::class, 'update'])->name('update-pasien');