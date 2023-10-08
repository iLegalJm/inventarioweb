<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\OrdenpedidoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

// Route::get('/', [ProductoController::class, 'index'])->name('productos.index');

Route::controller(ProductoController::class)->group(function () {
    Route::get('/', 'index')->name('productos.index');
    Route::get('productos/{producto}', 'show')->name('productos.show');
    Route::get('carrito', 'carrito')->name('productos.carrito');
    Route::get('checkout', 'checkout')->middleware('auth')->name('productos.checkout');
    // Route::get()
});

Route::controller(OrdenpedidoController::class)->group(function (){
    Route::post('ordenpedidos', 'store')->name('ordenpedidos.store');
});

/* El bloque de código define un grupo de rutas que está protegido por middleware. El middleware
incluye el middleware 'auth:sanctum', 'config('jetstream.auth_session')' y 'verified'. */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});