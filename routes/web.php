<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AutenticacionAdminController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\VentaController;

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
    Route::get('admin/usuarios/crearVentaUsuario/{id}', [UsuarioController::class,'crearVentaUsuario'])->name('usuarios.crearVentaUsuario');
    Route::get('/usuario/index', [UsuarioController::class, 'catalogoUsuario'])->name('usuario.index'); //Lleva al index a un usuario autenticado
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
    Route::get('admin/usuarios/crear', [UsuarioController::class,  'create'])->name('admin.usuarios.crear');
    Route::post('admin/usuarios', [UsuarioController::class,  'store'])->name('admin.usuarios.guardar');
    Route::delete('admin/usuarios/{id}', [UsuarioController::class,  'destroy'])->name('admin.usuarios.destroy');
    Route::get('admin/usuarios/editar/{id}', [UsuarioController::class,  'edit'])->name('usuarios.edit');
    Route::put('admin/usuarios/editar/{id}', [UsuarioController::class,  'update'])->name('usuarios.update');
    //Ruta para las ventas
    Route::get('admin/ventas', [VentaController::class,'index'])->name('admin.ventas.index');
    Route::get('admin/dispositivos/listaDispositivos', [UsuarioController::class,  'index'])->name('admin.dispositivos.listaDispositivos');
    Route::get('admin/usuarios/crearVenta/{id}', [UsuarioController::class,'crearVenta'])->name('admin.usuarios.crearVenta');
    Route::get('admin/usuarios/registrarVenta/{id}', [UsuarioController::class,'registrarVenta'])->name('admin.usuarios.registrarVenta');
    Route::get('admin/usuarios/descargarReportesVentas', [VentaController::class,'generarPDFReporteVentas'])->name('admin.usuarios.reporteVentas');

});
Route::get('admin/usuarios/descargarReportesVentasExcel', [VentaController::class,'generarExcelReporteVentas'])->name('admin.usuarios.reporteVentasExcel');
