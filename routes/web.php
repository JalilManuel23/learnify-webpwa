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
Route::get('/cursos', [App\Http\Controllers\CursoController::class, 'index'])->name('cursos');
Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');
Route::get('/examenes', [App\Http\Controllers\ExamenController::class, 'index'])->name('examenes');
Route::get('/instructores', [App\Http\Controllers\InstructorController::class, 'index'])->name('instructores');

Route::post('/agregar-rol', [App\Http\Controllers\RoleController::class, 'save']);
Route::post('/actualizar-rol/{id}', [App\Http\Controllers\RoleController::class, 'update']);
Route::post('/eliminar-rol/{id}', [App\Http\Controllers\RoleController::class, 'delete']);

// USUARIOS
Route::post('/agregar-usuario', [App\Http\Controllers\UserController::class, 'save']);
Route::post('/actualizar-usuario/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::post('/eliminar-usuario/{id}', [App\Http\Controllers\UserController::class, 'delete']);

// ESTUDIANTES
Route::post('/agregar-estudiante', [App\Http\Controllers\EstudianteController::class, 'save']);
Route::post('/actualizar-estudiante/{id}', [App\Http\Controllers\EstudianteController::class, 'update']);
Route::post('/eliminar-estudiante/{id}', [App\Http\Controllers\EstudianteController::class, 'delete']);

// CURSOS
Route::post('/agregar-curso', [App\Http\Controllers\CursoController::class, 'save']);
Route::post('/actualizar-curso/{id}', [App\Http\Controllers\CursoController::class, 'update']);
Route::post('/eliminar-curso/{id}', [App\Http\Controllers\CursoController::class, 'delete']);

// CATEGORIAS
Route::post('/agregar-categoria', [App\Http\Controllers\CategoriaController::class, 'save']);
Route::post('/actualizar-categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'update']);
Route::post('/eliminar-categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'delete']);

// EXAMENES
Route::post('/agregar-examen', [App\Http\Controllers\ExamenController::class, 'save']);
Route::post('/actualizar-examen/{id}', [App\Http\Controllers\ExamenController::class, 'update']);
Route::post('/eliminar-examen/{id}', [App\Http\Controllers\ExamenController::class, 'delete']);

Route::get('correo', [App\Http\Controllers\ExampleController::class, 'index']);

// INSTRUCTORES
Route::post('/agregar-instructor', [App\Http\Controllers\InstructorController::class, 'save']);
Route::post('/actualizar-instructor/{id}', [App\Http\Controllers\InstructorController::class, 'update']);
Route::post('/eliminar-instructor/{id}', [App\Http\Controllers\InstructorController::class, 'delete']);
