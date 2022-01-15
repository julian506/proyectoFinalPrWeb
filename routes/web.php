<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AutenticacionController;

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

Route::post('/auth/save', [AutenticacionController::class, 'save'])->name('auth.save'); //Hace el registro de usuario
Route::post('/auth/check', [AutenticacionController::class, 'check'])->name('auth.check'); //Hace el login de usuario
Route::post('/auth/logout', [AutenticacionController::class, 'logout'])->name('auth.logout'); //Hace el logout de usuario

Route::group(['middleware' => ['AutenticacionCheck']], function () {
    Route::get('/', [AutenticacionController::class, 'index'])->name('auth.index');
    Route::get('/auth/login', [AutenticacionController::class, 'login'])->name('auth.loginUser');
    Route::get('/auth/register', [AutenticacionController::class, 'register'])->name('auth.registerUser');
    Route::get('/usuario/index', [UsuarioController::class, 'usuarioIndex'])->name('usuario.index'); //Lleva al index a un usuario autenticado
});
