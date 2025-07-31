<?php

use App\Http\Controllers\Controladores\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsuarioController::class, 'index'])->name('home');
Route::get('/login', [UsuarioController::class, 'showLogin'])->name('login');
Route::get('/crear', [UsuarioController::class, 'showCrear'])->name('crear');
Route::post('/crear', [UsuarioController::class, 'store'])->name('crear.store');
Route::get('/usuarios', [UsuarioController::class, 'list'])->name('usuarios');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');