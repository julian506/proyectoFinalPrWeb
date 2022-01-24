<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    function usuarioIndex(){
        $dispositivos = Dispositivo::where('cantidad', '>', 0)->paginate(9);
        return view('usuario.index', compact('dispositivos'));
    }
}
