<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

use App\Exports\VentasExport;
use App\Models\Usuario;
use Maatwebsite\Excel\Facades\Excel;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::all();
        $ventasPorUsuario = DB::table('ventas')->select(DB::raw('idUsuario, count("idUsuario") as cantidadVentas'))->groupBy('idUsuario')->get();
        return view('admin.ventas.index')->with('ventas',$ventas)->with('ventasPorUsuario', $ventasPorUsuario);//Me retorna la vista de ventas y que valla con las ventas de la BD
    }

    public function generarPDFReporteVentas(){
        $ventasPorUsuario = DB::table('ventas')->select(DB::raw('idUsuario, count("idUsuario") as cantidadVentas'))->groupBy('idUsuario')->get();
        // return view('admin.ventas.reporteVentasPorUsuario', compact('ventasPorUsuario'));
        $pdf = PDF::loadview('admin.ventas.reporteVentasPorUsuario', compact('ventasPorUsuario'));
        return $pdf->download('reporte.pdf');
    }

    public function generarExcelReporteVentas(){
        return Excel::download(new VentasExport, 'reporteVentasPorUsuario.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
