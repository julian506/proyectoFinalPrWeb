<head>
    <link rel="stylesheet" href="{{ asset('css/estilosDatatable.css') }}">
</head>
<body>
	<div class="container" id="formularioAgregar">
		<h2 class="text-center"><i class="bi bi-node-plus"></i> Llena todos los campos</h2>

		<form class="row g-4" action="{{ route('dispositivos.update', $dispositivo->id) }}" method="POST" enctype="multipart/form-data">
            {{-- Token de seguridad --}}
            @method('PUT')
            @csrf
			<div class="col-md-8">
				<label for="validationCustom02" class="form-label">Nombre del Producto</label>
				<input type="text" class="form-control" id="validationCustom02" name="nombre" placeholder="Nombre" required value="{{ $dispositivo->nombre }}">
			</div>

            <div class="col-md-8">
				<label for="validationCustom02" class="form-label">Descripción</label>
				<textarea type="text" class="form-control" id="validationCustom02" name="descripcion" placeholder="Nombre" required >{{ $dispositivo->descripcion }}</textarea>
			</div>

			<div class="col-md-8">
				<label for="validationCustomUsername" class="form-label">Precio</label>
				<input type="number" class="form-control" id="validationCustomUsername" name="precio" placeholder="Su precio aquí" required value="{{ $dispositivo->precio }}">
			</div>


			<div class="col-md-8">
				<label for="ArchivoIMG" class="form-label">Archivo de Imagen</label>
                <p>Esta es la imagen actual que tienes, si deseas cambiarla selecciona un nuevo archivo, de lo contrario, no selecciones nada</p>
                <img id="imagenDT" src="{{ asset('storage').'/'.$dispositivo->imagen}}" alt="Imagen">
				<input type="file" class="form-control" id="ArchivoIMG" name="imagen" placeholder="">
			</div>

			<div class="col-md-12" id="B_Agregar">
				<input type="submit" class="btn btn-success" value="Editar"><i class="bi bi-node-plus"></i>
			</div>
		</form>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

