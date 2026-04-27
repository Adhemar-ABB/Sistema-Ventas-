<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /*Route::resources([
        'categorias' => CategoriaController::class,
        'marcas' => MarcaController::class,
        'presentaciones' => PresentacionController::class,
        'productos' => ProductoController::class,
    ]);*/


  Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');


Route::resource('marcas', MarcaController::class);
    
Route::resource('proveedores', ProveedorController::class);

Route::resource('categorias', CategoriaController::class);
    

    

Route::resource('clientes', ClienteController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
