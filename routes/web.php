<?php

use App\Http\Controllers\web\BrandController;
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

Route::get('/', function () {
    return view('layouts/app');
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/brand', 'index')->name('brand.index');
    Route::get('/brand/all', 'all')->name('brand.all');
    Route::get('/brand/{id?}', 'show')->name('brand.show');
    Route::post('/brand', 'store')->name('brand.store');
    Route::put('/brand/{id}', 'update')->name('brand.update');
    Route::delete('/brand/{id}', 'destroy')->name('brand.destroy');
});
