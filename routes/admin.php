<?php

use App\Http\Controllers\Admin\AlmacenController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use Illuminate\Support\Facades\Route;

// Route::get('', [HomeController::class, 'index'])->name('admin.home');
Route::controller(HomeController::class)->group(function () {
    Route::get('', 'index')->name('admin.home');
    Route::get('almacen/{almacen}', 'almacen')->name('admin.almacen');
});

Route::resource('almacenes', AlmacenController::class)->names('admin.almacenes');
Route::resource('productos', AdminProductoController::class)->names('admin.productos');
?>