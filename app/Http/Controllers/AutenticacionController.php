<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Añado el modelo de usuario para poder conectar con la base de datos
use App\Models\Usuario;
// Añado Hash para poder encriptar y desencriptar contraseñas
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller
{

    function index(){
        return view('auth.loginUser');
    }

    function login(){
        return view('auth.loginUser');
    }

    function register(){
        return view('auth.registerUser');
    }

    function save(Request $request){
        $camposFormulario = [
            'nombre'=>'required|string|max:100',
            'apellidos'=>'required|string|max:100',
            'correo'=>'required|email|unique:usuarios',
            'password'=>'required|min:5',
            'passwordConfirm'=>'required|min:5',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
            'correo.required' => 'El correo electrónico es requerido',
            'correo.unique' => 'El correo electrónico ingresado ya está en uso',
            'password.required' => 'La contraseña es requerida',
            'passwordConfirm.required' => 'La confirmación de la contraseña es requerida',
            'password.min' => 'La contraseña debe tener mínimo 5 caracteres',
            'passwordConfirm.min' => 'La contraseña debe tener mínimo 5 caracteres'
        ];

        $this->validate($request, $camposFormulario, $message);

        //Insertamos los datos en la base de datos
        $usuario = new Usuario;
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo;
        if($request->password != $request->passwordConfirm){
            return back()->with('fail', 'Error, las contraseñas no coinciden');
        }else{
            $usuario->password = Hash::make($request->password); //Encripto la contraseña
        }

        $save = $usuario->save();

        if($save){
            return redirect()->route('auth.loginUser')->with('success', 'Se ha creado el usuario, ya puedes iniciar sesión');
        }else{
            return back()->with('fail', 'Ha ocurrido un error creando el usuario');
        }
    }

    // Con esta función o método realizo el login de un usuario previamente registrado en la base de datos
    function check(Request $request){
        //Hago la validación de los campos del formulario
        $camposFormulario = [
            'correo'=>'required|email',
            'password'=>'required|min:5',
        ];

        $message = [
            'correo.required' => 'El correo electrónico es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener mínimo 5 caracteres',
        ];

        $this->validate($request, $camposFormulario, $message);

        //Consulto los datos del Usuario con el email que se ha ingresado al formulario
        $datosUsuario = Usuario::where('correo', '=', $request->correo)->first();

        if(!$datosUsuario){
            return back()->with('fail', 'No se ha encontrado ningún usuario con dicho correo electrónico');
        }else{
            // Verificamos la contraseña
            if(Hash::check($request->password, $datosUsuario->password)){
                $request->session()->put('LoggedUser', $datosUsuario->id); //Nos referiremos al id del usuario loggeado por el nombre loggedUser
                $nombreCompleto = $datosUsuario->nombre." ".$datosUsuario->apellidos;
                $request->session()->put('nombreCompletoUsuario', $nombreCompleto);
                //Llevo al usuario loggeado al index de usuario. Esta línea va a web.php y ve que esta ruta llama a AutenticacionController en su metodo usuarioIndex
                return redirect('usuario/index');
            }else{
                return back()->with('fail', 'La contraseña ingresada es incorrecta');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            session()->pull('nombreCompletoUsuario');
            return redirect()->route('auth.index');
        }
    }
}
