@extends('layouts.appAdmin')
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
                <th>Apellidos</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->correo }}</td>


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
