@extends('layouts.appAdmin')
<div class="container text-center">
    <a href="{{ route("admin.usuarios.crear") }}">
        <button class="btn btn-success">
            Crear
        </button>
    </a>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <td>Opciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>
                        <a >
                            <button class="btn btn-primary">
                                Editar
                            </button>
                        </a>
                        {{-- Formulario de borrado --}}
                        <form  method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
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
