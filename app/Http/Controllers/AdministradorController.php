<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    function panelPrincipal(){
        return view('admin.index');
    }

    function registrarAdmin(){
        return view('auth.registerAdmin');
    }
}
