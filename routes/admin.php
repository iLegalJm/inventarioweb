<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('', [HomeController::class, 'index'])->name('admin.home');
Route::controller(HomeController::class)->group(function () {
    Route::get('', 'index')->name('admin.home');
    Route::get('almacen/{almacen}', 'almacen')->name('admin.almacen');
});
?>