<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hello, world!</title>
</head>

<body>
	<style>
		h1 {
			text-align: center;
		}

		table.minimalistBlack {
			border: 3px solid #000000;
			width: 100%;
			text-align: left;
			border-collapse: collapse;
		}

		table.minimalistBlack td,
		table.minimalistBlack th {
			border: 1px solid #000000;
			padding: 5px 4px;
		}

		table.minimalistBlack tbody td {
			font-size: 13px;
		}

		table.minimalistBlack thead {
			background: #CFCFCF;
			background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
			background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
			background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
			border-bottom: 3px solid #000000;
		}

		table.minimalistBlack thead th {
			font-size: 15px;
			font-weight: bold;
			color: #000000;
			text-align: left;
		}

		table.minimalistBlack tfoot {
			font-size: 14px;
			font-weight: bold;
			color: #000000;
			border-top: 3px solid #000000;
		}

		table.minimalistBlack tfoot td {
			font-size: 14px;
		}

	</style>
	<h1>Reporte de ventas por usuario</h1>
	<div>
		<table class="minimalistBlack">
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
								$usuario = App\Models\Usuario::where('id', $ventaUsuario->idUsuario)->first();
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
</body>

</html>
