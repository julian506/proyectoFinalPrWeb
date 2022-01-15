<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AutenticacionAdminController;

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

Route::post('/admin/auth/check', [AutenticacionAdminController::class, 'checkAdmin'])->name('admin.auth.check');
Route::post('/admin/auth/logout', [AutenticacionAdminController::class, 'logoutAdmin'])->name('admin.auth.logout');

Route::group(['middleware' => ['AutenticacionAdminCheck']], function () {
    Route::get('/admin', [AutenticacionAdminController::class, 'index'])->name('auth.indexAdmin');
    Route::get('/admin/login', [AutenticacionAdminController::class, 'login'])->name('auth.loginAdmin');
    Route::get('/admin/panelAdministrador', [AdministradorController::class, 'panelPrincipal'])->name('admin.panelPrincipal');
    Route::get('/admin/registrarAdmin', [AdministradorController::class, 'registrarAdmin'])->name('admin.registrarNuevoAdmin');
    Route::post('/admin/saveAdmin', [AutenticacionAdminController::class, 'saveAdmin'])->name('auth.saveAdmin');

});
