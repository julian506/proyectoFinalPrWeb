<div class="container text-center">
    <a href="{{ route("dispositivos.create") }}">
        <button class="btn btn-success">
            Crear
        </button>
    </a>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Opciones</th>
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
                        <a href="{{ route('dispositivos.edit', $dispositivo->id) }}">
                            <button class="btn btn-primary">
                                Editar
                            </button>
                        </a>
                        {{-- Formulario de borrado --}}
                        <form action="{{ route('dispositivos.destroy',$dispositivo->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro que desea eliminar al {{ $dispositivo->nombre }}?')" value="Borrar">
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
                <th>Opciones</th>
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
