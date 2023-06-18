<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', MainController::class . '@index');

Route::get('/login', MainController::class . '@login');
Route::post('/login', MainController::class . '@loginProses');
Route::get('/register', MainController::class . '@register');
Route::post('/register', MainController::class . '@registerProses');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', ProductController::class . '@index')->name('admin-product');
    Route::post('/admin/product', ProductController::class . '@store')->name('add-product');
    Route::get('/admin/edit-product/{id}', ProductController::class . '@edit')->name('ubah-product');
    Route::post('/admin/edit-product/{id}', ProductController::class . '@editProses')->name('ubah-product-proses');
    Route::get('/admin/delete-product/{id}', ProductController::class . '@delete')->name('hapus-product');

    Route::get('/admin/hero', HeroController::class . '@index')->name('admin-hero');
    Route::post('/admin/hero', HeroController::class . '@store')->name('add-hero');
    Route::get('/admin/edit-hero/{id}', HeroController::class . '@edit')->name('ubah-hero');
    Route::post('/admin/edit-hero/{id}', HeroController::class . '@editProses')->name('ubah-hero-proses');
    Route::get('/admin/delete-hero/{id}', HeroController::class . '@delete')->name('hapus-hero');
    Route::get('/logout', MainController::class . '@logout');
});