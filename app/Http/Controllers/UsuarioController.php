<?php

namespace App\Http\Controllers;
// Añado Hash para poder encriptar y desencriptar contraseñas
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Dispositivo;
use App\Models\Venta;
use App\Http\Controllers\Session;
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
            return redirect()->route('admin.usuarios.index')->with('success', 'Se ha creado el usuario con éxito.');
        }else{
            return redirect()->route('admin.usuarios.index')->with('fail', 'Ha ocurrido un error creando al usuario. Inténtelo nuevamente.');
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
        return view('admin.usuarios.editar')->with('usuario',$usuario);
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
        $save = $usuario->save();
        if($save){
            return redirect()->route('admin.usuarios.index')->with('success', 'Se ha editado el usuario con éxito.');
        }else{
            return redirect()->route('admin.usuarios.index')->with('fail', 'Ha ocurrido un error editando al usuario. Inténtelo nuevamente.');
        }
    }

    public function crearVentaUsuario(Request $request, $id){
        $dispositivo = Dispositivo::where('id', $id)->first(); //Así devolvería un solo valor
        $nuevaVenta = new Venta();
        $nuevaVenta->idUsuario = $request->session()->get('LoggedUser');
        $nuevaVenta->idDispositivo = $request->idDispositivo;
        $nuevaVenta->cantidad = $request->cantidad;
        $nuevaVenta->total = $dispositivo->precio*$request->cantidad;
        $nuevaVenta->save();
        $dispositivo->cantidad = $dispositivo->cantidad  - $request->cantidad;
        $save = $dispositivo->save();
        if($save){
            return redirect()->route('usuario.index')->with('success', '¡Felicitaciones! Ha comprado '.$nuevaVenta->cantidad.' unidad(es) de '.$dispositivo->nombre);
        }else{
            return redirect()->route('usuario.index')->with('fail', 'Ha habido un error con su compra, intente nuevamente.');
        }

    }

    public function crearVenta($id){
        $dispositivos = Dispositivo::all();
        $usuario = Usuario::where('id', $id)->first(); //Así devolvería un solo valor
        return view('admin.dispositivos.listaDispositivos', compact('dispositivos', 'usuario'));
    }

    public function registrarVenta(Request $request, $id){
        $dispositivo = Dispositivo::find($id);
        $usuario = Usuario::find($request->idUsuario);
        $nuevaVenta = new Venta();
        $nuevaVenta->idUsuario = $request->idUsuario;
        $nuevaVenta->idDispositivo = $request->idDispositivo;
        $nuevaVenta->cantidad = $request->cantidad;
        $nuevaVenta->total = $dispositivo->precio*$request->cantidad;
        $nuevaVenta->save();
        $dispositivo->cantidad = $dispositivo->cantidad  - $request->cantidad;
        $save = $dispositivo->save();
        if($save){
            return redirect()->route('admin.usuarios.index')->with('success', 'Se ha registrado una compra de '.$nuevaVenta->cantidad.' unidad(es) de '.$dispositivo->nombre.' a nombre del usuario '.$usuario->nombre.' '.$usuario->apellidos.'.');
        }else{
            return redirect()->route('admin.usuarios.index')->with('fail', 'Ha habido un error con la compra, intente nuevamente.');
        }
    }
}
