<div class="container mt-3 text-center">
    @php
        $suma = 0;
    @endphp
    <table id="dataTableVentasPorUsuario" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre usuario</th>
                <th>Apellido usuario</th>
                <th>Cantidad de ventas</th>
                <th>Cantidad total en dólares</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasPorUsuario as $ventaUsuario)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @php
                            $usuario = App\Models\Usuario::where('id',$ventaUsuario->idUsuario)->first();
                            echo $usuario->nombre;
                        @endphp
                    </td>
                    <td>
                        @php
                            echo $usuario->apellidos;
                        @endphp
                    </td>
                    <td>
                        {{ $ventaUsuario->cantidadVentas }}
                    </td>
                    <td>
                        @php
                            $total = App\Models\Venta::where('idUsuario', $ventaUsuario->idUsuario)->sum('total');
                            echo $total;

                            // $acumulado = 0;
                            // $ventas = App\Models\Venta::where('idUsuario', $ventaUsuario->idUsuario)->get();
                            // foreach ($ventas as $venta) {
                            //     $dispositivo = App\Models\Dispositivo::where('id', $venta->idDispositivo)->first();
                            //     $acumulado += $venta->cantidad * $dispositivo->precio;
                            // }
                            // echo $acumulado;
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Nombre usuario</th>
                <th>Apellido usuario</th>
                <th>Cantidad de ventas</th>
                <th>Cantidad total en dólares</th>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function () {
        var table = $('#dataTableVentasPorUsuario').DataTable({
            responsive: true
        });
        new $.fn.dataTable.FixedHeader(table);
    });
</script>
