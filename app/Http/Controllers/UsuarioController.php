<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    function usuarioIndex(){
        return view('usuario.index');
    }
}
