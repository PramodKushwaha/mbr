<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMSController;

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
    return view('welcome');
});

// CMS Route 
Route::group(['prefix' => 'cms'], function () {
    Route::get('/', [CMSController::class, 'index'])->name('cms.index');
    Route::get('create', [CMSController::class, 'create'])->name('cms.create');
    Route::post('store', [CMSController::class, 'store'])->name('cms.store');
    Route::get('edit/{id}', [CMSController::class, 'edit'])->name('cms.edit');
    Route::post('update/{id}', [CMSController::class, 'update'])->name('cms.update');
    Route::delete('delete', [CMSController::class, 'destroy'])->name('cms.delete');
});

// Page Route
Route::group(['prefix' => 'pages'], function () {
    Route::get('/', [CMSController::class, 'getPages'])->name('pages.index');
    Route::get('/{slug}', [CMSController::class, 'showPage'])->where('slug', '.*');
});
