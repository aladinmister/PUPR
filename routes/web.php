<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PengawasanController;
use App\Http\Controllers\KonstruksiController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PembangunanBendunganController;
use App\Http\Controllers\PembangunanembungdanairController;





Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ProgramSDA', [BerandaController::class, 'ProgramSDA'])->name('ProgramSDA');


Route::get('/Rekapan', [PerencanaanController::class, 'Rekapan'])->name('Rekapan');
Route::get('/DokumenPengadaan', [PerencanaanController::class, 'DokumenPengadaan'])->name('DokumenPengadaan');
Route::get('/DokumenKontrak', [PerencanaanController::class, 'DokumenKontrak'])->name('DokumenKontrak');


Route::get('/RekapanPengawasan', [PengawasanController::class, 'Rekapan'])->name('RekapanPengawasan');
Route::get('/DokumenPengadaanPengawasan', [PengawasanController::class, 'DokumenPengadaan'])->name('DokumenPengadaanPengawasan');
Route::get('/DokumenKontrakPengawasan', [PengawasanController::class, 'DokumenKontrak'])->name('DokumenKontrakPengawasan');


Route::get('/RekapanKonstruksi', [KonstruksiController::class, 'Rekapan'])->name('RekapanKonstruksi');
Route::get('/DokumenPengadaanKonstruksi', [KonstruksiController::class, 'DokumenPengadaan'])->name('DokumenPengadaanKonstruksi');
Route::get('/DokumenKontrakKonstruksi', [KonstruksiController::class, 'DokumenKontrak'])->name('DokumenKontrakKonstruksi');




Route::get('/master', [MasterController::class, 'index'])->name('master.index');
Route::get('/master/create', [MasterController::class, 'create'])->name('master.create');
Route::post('/tambahmaster', [MasterController::class, 'store'])->name('master.store');
Route::get('master/{id}/edit/{key}', [MasterController::class, 'edit'])->name('master.edit');
Route::put('master/{id}/update/{key}', [MasterController::class, 'update'])->name('master.update');
Route::delete('master/{id}/{key}', [MasterController::class, 'destroy'])->name('master.delete');
Route::delete('/master/{id}/{key}', [MasterController::class, 'destroy'])->name('master.destroy');


//Pembangunan Bendungan
Route::get('/pembangunan-bendungan', [PembangunanBendunganController::class, 'index'])->name('pembangunan-bendungan.index');
Route::get('/pembangunan-bendungan/create', [PembangunanBendunganController::class, 'create'])->name('pembangunan-bendungan.create');
Route::post('/tambahpembangunan-bendungan', [PembangunanBendunganController::class, 'store'])->name('pembangunan-bendungan.store');
Route::get('pembangunan-bendungan/{id}/edit/{key}', [PembangunanBendunganController::class, 'edit'])->name('pembangunan-bendungan.edit');
Route::put('pembangunan-bendungan/{id}/update/{key}', [PembangunanBendunganController::class, 'update'])->name('pembangunan-bendungan.update');
Route::delete('pembangunan-bendungan/{id}/{key}', [PembangunanBendunganController::class, 'destroy'])->name('pembangunan-bendungan.delete');
Route::delete('/pembangunan-bendungan/{id}/{key}', [PembangunanBendunganController::class, 'destroy'])->name('pembangunan-bendungan.destroy');

//Pembangunan Embung dan Air
Route::get('/pembangunan-embung-dan-air', [PembangunanembungdanairController::class, 'index'])->name('Pembangunan-embung-dan-air.index');
Route::get('/pembangunan-embung-dan-air/create', [PembangunanembungdanairController::class, 'create'])->name('Pembangunan-embung-dan-air.create');
Route::post('/pembangunan-embung-dan-air', [PembangunanembungdanairController::class, 'store'])->name('Pembangunan-embung-dan-air.store');
Route::get('/pembangunan-embung-dan-air/{id}/edit/{key}', [PembangunanembungdanairController::class, 'edit'])->name('Pembangunan-embung-dan-air.edit');
Route::put('/pembangunan-embung-dan-air/{id}/update/{key}', [PembangunanembungdanairController::class, 'update'])->name('Pembangunan-embung-dan-air.update');
Route::delete('/pembangunan-embung-dan-air/{id}/{key}', [PembangunanembungdanairController::class, 'destroy'])->name('Pembangunan-embung-dan-air.destroy');








