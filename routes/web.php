<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::view('admin', 'admin.index');
Route::view('admin/example', 'admin.example');
Auth::routes();
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ejemplo', [App\Http\Controllers\RoleController::class, 'index'])->name('ejemplo');
Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios');
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
Route::get('/estudiantes', [App\Http\Controllers\EstudianteController::class, 'index'])->name('estudiantes');

Route::post('/agregar-rol', [App\Http\Controllers\RoleController::class, 'save']);
Route::post('/actualizar-rol/{id}', [App\Http\Controllers\RoleController::class, 'update']);
Route::post('/eliminar-rol/{id}', [App\Http\Controllers\RoleController::class, 'delete']);

//USUARIOS
Route::post('/agregar-usuario', [App\Http\Controllers\UserController::class, 'save']);
Route::post('/actualizar-usuario/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::post('/eliminar-usuario/{id}', [App\Http\Controllers\UserController::class, 'delete']);

