@extends('layouts.appAdmin')

@section('content')
    <div class="container">
        {{-- Acá se obtiene el mensaje de éxito enviado desde AutenticacionController --}}
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        {{-- Acá se obtiene el mensaje de fracaso enviado desde AutenticacionController --}}
        @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Panel de administrador</h3>
            </div>
            <div class="card-body">
                <h3 class="text-center"> N° Dispositivos: {{ count($dispositivos) }}</h3>
                <div class="container text-center">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Imagen</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dispositivos as $dispositivo)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dispositivo->nombre }}</td>
                                    <td>{{ $dispositivo->descripcion }}</td>
                                    <td>{{ $dispositivo->precio }}</td>
                                    <td>{{ $dispositivo->cantidad }}</td>
                                    <td><img id="imagenDT" src="{{ asset('storage').'/'.$dispositivo->imagen}}" alt="{{ $dispositivo->textoAlternativoImagen }}"></td>
                                    <td>
                                        <form action="{{ route('admin.usuarios.registrarVenta', $dispositivo->id) }}" method="get">
                                            <input type="text" value = '{{ $usuario->id }}' name="idUsuario" hidden>
                                            <input type="text" value = '{{ $dispositivo->id }}' name="idDispositivo" hidden>
                                            <input type="number" placeholder="Cantidad" name="cantidad" id='cantidadForm' max="{{ $dispositivo->cantidad }}" min="1" required>
                                            @csrf
                                            <input class="btn btn-success" type="submit" value="Vender">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Imagen</th>
                                <th>Opción</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <script>
                    $(document).ready(function () {
                        var table = $('#example').DataTable({
                            responsive: true
                        });
                        new $.fn.dataTable.FixedHeader(table);
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
