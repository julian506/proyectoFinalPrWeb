<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    function usuarioIndex(){
        $dispositivos = Dispositivo::where('cantidad', '>', 0)->paginate(6);
        return view('usuario.index', compact('dispositivos'));
    }
    function index(){
        $usuarios=Usuario::all();
        return view('admin.usuarios.index')->with('usuarios',$usuarios);
        //return view('admin.usuario.idex', compact('usuarios')); //Equivalente
    }
    function create(){
        return view('admin.usuarios.crear');
    }
}
