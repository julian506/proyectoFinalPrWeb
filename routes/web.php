<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AutenticacionAdminController;
use App\Http\Controllers\DispositivoController;

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
    Route::get('/admin/panelAdministrador', [DispositivoController::class, 'index'])->name('admin.panelPrincipal');
    Route::get('/admin/registrarAdmin', [AdministradorController::class, 'registrarAdmin'])->name('admin.registrarNuevoAdmin');
    Route::post('/admin/saveAdmin', [AutenticacionAdminController::class, 'saveAdmin'])->name('auth.saveAdmin');
    Route::resource('admin/dispositivos',DispositivoController::class);
    Route::get('admin/usuarios', [UsuarioController::class,  'index'])->name('admin.usuarios.index');//AX-Ruta para ir al crud de usuarios
});


// Rutas para el CRUD de dispositivos
// Route::get('/', [DispositivoController::class,'index']);


// Route::get('/clientes/create', [ClienteController::class,'create'])->name('clientes.create');
// Route::post('/clientes/store', [ClienteController::class,'store'])->name('clientes.store');
// Route::get('/clientes/edit/{id}', [ClienteController::class,'edit'])->name('clientes.edit');
// Route::patch('/clientes/update/{id}', [ClienteController::class,'update'])->name('clientes.update');
// Route::delete('/clientes/destroy/{id}', [ClienteController::class,'destroy'])->name('clientes.destroy');
// Route::get('/clientes/crearVenta/{id}', [ClienteController::class,'crearVenta'])->name('clientes.crearVenta');
// Route::post('/clientes/registrarVenta', [ClienteController::class,'registrarVenta'])->name('clientes.registrarVenta');
