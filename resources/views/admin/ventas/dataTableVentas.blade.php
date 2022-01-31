<div class="container text-center">
    @php
        $suma = 0;
    @endphp
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>N.Venta</th>
                <th>Nombre usuario</th>
                <th>Apellido usuario</th>
                <th>Dispositivo</th>
                <th>Cantidad</th>
                <th>Total en dólares</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @php
                            $usuario = App\Models\Usuario::where('id',$venta->idUsuario)->first();
                            echo $usuario->nombre;
                        @endphp
                    </td>
                    <td>
                        @php
                            $usuario = App\Models\Usuario::where('id',$venta->idUsuario)->first();
                            echo $usuario->apellidos;
                        @endphp
                    </td>
                    <td>
                        @php
                            $dispositivo = App\Models\Dispositivo::where('id', $venta->idDispositivo)->first();
                            echo $dispositivo->nombre;
                        @endphp
                    </td>
                    <td>
                        @php
                            echo $venta->cantidad;
                        @endphp
                    </td>
                    <td>
                        @php
                            $total = $dispositivo->precio * $venta->cantidad;
                            $suma = $suma + $total;
                            echo $total;
                        @endphp
                    </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>N.Venta</th>
                <th>Nombre usuario</th>
                <th>Apellido usuario</th>
                <th>Dispositivo</th>
                <th>Cantidad</th>
                <th>Total en dólares</th>
            </tr>
        </tfoot>
    </table>
    <div id="letrero">
        @php
            echo "El total de todas las ventas es: $suma dólares";
        @endphp
    </div>
</div>
<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            responsive: true
        });
        new $.fn.dataTable.FixedHeader(table);
    });
</script>
