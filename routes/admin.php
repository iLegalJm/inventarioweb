<?php

use App\Http\Controllers\Admin\AlmacenController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrdeningresoController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrdenpedidoController as AdminOrdenpedidoController;
use App\Http\Controllers\Admin\OrdensalidaController;
use App\Http\Controllers\Admin\OrdenventaController;
use Illuminate\Support\Facades\Route;

// Route::get('', [HomeController::class, 'index'])->name('admin.home');
Route::controller(HomeController::class)->group(function () {
    Route::get('', 'index')->middleware('can:admin.home')->name('admin.home');
    Route::get('almacen/{almacen}', 'almacen')->name('admin.almacen');
});

Route::resource('users', UserController::class)->only('index', 'edit', 'update')->names('admin.users');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('almacenes', AlmacenController::class)->names('admin.almacenes');
Route::resource('ordenpedidos', AdminOrdenpedidoController::class)->names('admin.ordenpedidos');
Route::resource('ordenventas', OrdenventaController::class)->names('admin.ordenventas');
Route::resource('productos', AdminProductoController::class)->names('admin.productos');
Route::resource('ingresos', OrdeningresoController::class)->names('admin.ingresos');
Route::resource('salidas', OrdensalidaController::class)->names('admin.salidas');
Route::resource('categorias', CategoriaController::class)->names('admin.categorias');