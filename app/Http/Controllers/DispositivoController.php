<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispositivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Para traer todos los productos de la BD:
        $dispositivos = Dispositivo::all();
        return view('admin/dispositivos.index')->with('dispositivos', $dispositivos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Sirve para redireccionarme a la vista
        return view("admin/dispositivos.guardar");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dispositivo = new Dispositivo();
        $dispositivo->nombre = $request->nombre;
        $dispositivo->descripcion = $request->descripcion;
        $dispositivo->precio = $request->precio;
        $dispositivo->cantidad = $request->cantidad;
        if($request->hasFile('imagen')){
            $dispositivo->imagen = $request->file('imagen')->store('uploads','public');
        }
        $dispositivo->textoAlternativoImagen = $request->textoAlternativoImagen;
        $dispositivo->save();

        return redirect()->route('dispositivos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function show(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dispositivo = Dispositivo::find($id);
        return view('admin/dispositivos.editar')->with('dispositivo',$dispositivo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
        ]);

        $dispositivo = Dispositivo::find($id);

        $dispositivo->nombre = $request->nombre;
        $dispositivo->descripcion = $request->descripcion;
        $dispositivo->precio = $request->precio;
        $dispositivo->cantidad = $request->cantidad;
        //Si en el formulario se adjuntó una NUEVA foto...
        if($request->hasFile('imagen')){
            //Borramos de la carpeta public aquella imagen que tenga la misma ruta que $empleado->foto
            Storage::delete('public/'.$dispositivo->imagen);
            //Suba la NUEVA foto a la carpeta uploads en public y en el JSON guarde la dirección de la foto
            $dispositivo->imagen = $request->file('imagen')->store('uploads', 'public');
        }
        $dispositivo->textoAlternativoImagen = $request->textoAlternativoImagen;
        $dispositivo->save();

        return redirect()->route('dispositivos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dispositivo = Dispositivo::where('id', $id);
        $dispositivo->delete();
        return redirect()->route('dispositivos.index');
    }
}
