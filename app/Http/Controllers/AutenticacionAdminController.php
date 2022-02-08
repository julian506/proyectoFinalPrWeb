<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;
// Añado Hash para poder encriptar y desencriptar contraseñas
use Illuminate\Support\Facades\Hash;

class AutenticacionAdminController extends Controller
{
    function index(){
        return view('auth.loginAdmin');
    }

    function login(){
        return view('auth.loginAdmin');
    }

    function register(){
        return view('auth.registerAdmin');
    }

    function saveAdmin(Request $request){
        $camposFormulario = [
            'correo'=>'required|email|unique:administradors',
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
        $administrador = new Administrador;
        $administrador->correo = $request->correo;
        $administrador->password = Hash::make($request->password); //Encripto la contraseña

        $save = $administrador->save();

        if($save){
            return redirect()->route('admin.panelPrincipal')->with('success', 'Se ha creado el nuevo administrador');
        }else{
            return back()->with('fail', 'Ha ocurrido un error creando el administrador');
        }
    }

    // Con esta función o método realizo el login de un usuario previamente registrado en la base de datos
    function checkAdmin(Request $request){
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
        $datosAdministrador = Administrador::where('correo', '=', $request->correo)->first();

        if(!$datosAdministrador){
            return back()->with('fail', 'No se ha encontrado ningún administrador con dicho correo electrónico');
        }else{
            // Verificamos la contraseña
            if(Hash::check($request->password, $datosAdministrador->password)){
                $request->session()->put('LoggedAdmin', $datosAdministrador->id); //Nos referiremos al id del Administrador loggeado por el nombre loggedUser
                $correoAdmin = $datosAdministrador->correo;
                $request->session()->put('correoAdmin', $correoAdmin);
                //Llevo al Administrador loggeado al index de Administrador. Esta línea va a web.php y ve que esta ruta llama a AutenticacionAdminController en su metodo AdministradorIndex
                return redirect()->route('admin.panelPrincipal');
            }else{
                return back()->with('fail', 'La contraseña ingresada es incorrecta');
            }
        }
    }

    function logoutAdmin(){
        if(session()->has('LoggedAdmin')){
            session()->pull('LoggedAdmin');
            session()->pull('correoAdmin');
            return redirect()->route('auth.indexAdmin');
        }
    }
}
