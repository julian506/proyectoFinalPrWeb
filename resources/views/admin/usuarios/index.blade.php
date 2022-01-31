@extends('layouts.appAdmin')
@section('content')
	<div class="container text-center">
		<div class="card">
			<div class="card-header">
				<h3 class="text-center">CRUD de usuarios</h3>
			</div>
			<div class="card-body">
				<a href="{{ route('admin.usuarios.crear') }}">
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
									<a href="{{ route('usuarios.edit', $usuario->id) }}">
										<button class="btn btn-primary">
											Editar
										</button>
									</a>
									{{-- Formulario de borrado --}}
									<form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="post">
										@method('DELETE')
										@csrf
										<input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
									</form>
                                    <a href=" {{ route('admin.usuarios.crearVenta', $usuario->id) }}">
                                        <button class="btn btn-success">
                                            Registrar venta
                                        </button>
                                    </a>
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
							<th>Opciones</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<script>
	 $(document).ready(function() {
	  var table = $('#example').DataTable({
	   responsive: true
	  });
	  new $.fn.dataTable.FixedHeader(table);
	 });
	</script>
@endsection
