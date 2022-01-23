<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/estilosDatatable.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- cdn's necesarios para las data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- cdn's para que las data - tables sean responsivas -->
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <!-- CDN de plot.ly -->
    <script src="https://cdn.plot.ly/plotly-2.6.3.min.js"></script>

    <title>CRUD dispositivos</title>
</head>
<body>
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
                        <td><img id="imagenDT" src="{{ asset('storage').'/'.$dispositivo->imagen}}" alt=""></td>
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
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="api.js"></script>
    <script src="script.js"></script>

    <!-- Información de los data tables obtenida de: https://datatables.net/extensions/fixedheader/examples/integration/responsive-bootstrap.html -->
    <!-- Scripts necesarios para las data tables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
    <!-- Scripts para que sea responsive -->
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                responsive: true
            });
            new $.fn.dataTable.FixedHeader(table);
        });
    </script>

</body>
</html>
