<?php

namespace App\Exports;

use App\Models\Venta;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
// Imcluyo esto para poder definir los encabezados de columna
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Obtengo las ventas por usuario
        $ventasPorUsuario = DB::table('ventas')->select(DB::raw('idUsuario, count("idUsuario") as cantidadVentas'))->groupBy('idUsuario')->get();

        // Por cada registro cambio el id del usuario por su nombre y apellidos y agrego un campo al registro con el total de la venta
        foreach($ventasPorUsuario as $registro){
            // Guardo el id Original
            $idOriginal = $registro->idUsuario;
            $usuario = Usuario::where('id', $registro->idUsuario)->first();
            // Cambio el id por los nombres en el registro
            $registro->idUsuario = $usuario->nombre.' '.$usuario->apellidos;
            // Obtengo el total de la venta y lo agrego
            $total = Venta::where('idUsuario', $idOriginal)->sum('total');
            $registro->cantidadTotalDolares = $total;
        }
        return $ventasPorUsuario;
    }
    // Defino los encabezados de las columnas
    public function headings(): array
    {
        return [
            'Nombre y Apellidos del cliente',
            'Cantidad de ventas',
            'Cantidad total en dólares'
        ];
    }
}
