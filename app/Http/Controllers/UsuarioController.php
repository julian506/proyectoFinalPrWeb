<?php

namespace App\Http\Controllers;
// Añado Hash para poder encriptar y desencriptar contraseñas
use Illuminate\Support\Facades\Hash;
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
    function store(Request $request){
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
        $usuario->password = Hash::make($request->password); //Encripto la contraseña

        $save = $usuario->save();

        if($save){
            return redirect()->route('admin.usuarios.index');
        }else{
            return back()->with('fail', 'Ha ocurrido un error creando el usuario');
        }
    }
    function destroy($correo){
        $usuario = Usuario::find($correo);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index');
    }

    public function edit($id)
    {
        $usuario = Usuario::find($id);
        return view('admin.usuario.editar')->with('dispositivo',$usuario);
    }
    public function update(Request $request,$id){

        $validated =$request->validate([
            'nombre' => 'required',
            'apellidos'=>'required',
            'correo' =>'required'
        ]);

        $usuario = Usuario::find($id);
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo;
        $usuario->save();
        return redirect()->route('admin.usuarios.index');
    }
}
