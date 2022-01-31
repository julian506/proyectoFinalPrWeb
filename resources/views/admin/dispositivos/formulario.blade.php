<div class="container" id="formularioAgregar">
    <h2 class="text-center"><i class="bi bi-node-plus"></i> Llena todos los campos</h2>

    <form class="row g-4" action="{{ route('dispositivos.store') }}" method="POST" enctype="multipart/form-data">
        {{-- Token de seguridad --}}
        @csrf


        <div class="col-md-8">
            <label for="validationCustom02" class="form-label">Nombre del dipositivo</label>
            <input type="text" class="form-control" id="validationCustom02" name="nombre" placeholder="Nombre" required>
        </div>

        <div class="col-md-8">
            <label for="validationCustom02" class="form-label">Descripción</label>
            <textarea type="text" class="form-control" id="validationCustom02" name="descripcion" placeholder="Descripción" required></textarea>
        </div>

        <div class="col-md-8">
            <label for="validationCustom02" class="form-label">Precio</label>
            <input type="number" class="form-control" id="validationCustom02" name="precio" placeholder="Precio" required>
        </div>

        <div class="col-md-8">
            <label for="validationCustom02" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="validationCustom02" name="cantidad" placeholder="Cantidad" required>
        </div>

        <div class="col-md-8">
            <label for="ArchivoIMG" class="form-label">Archivo de Imagen</label>
            <input type="file" class="form-control" id="ArchivoIMG" name="imagen" required>
        </div>

        <div class="col-md-8">
            <label for="ArchivoIMG" class="form-label">Texto alternativo de la imagen</label>
            <input type="text" class="form-control" id="ArchivoIMG" name="textoAlternativoImagen" required>
        </div>

        <div class="col-md-12" id="B_Agregar">
            <input type="submit" class="btn btn-success" value="Agregar"><i class="bi bi-node-plus"></i>
            <a href="{{ route('admin.panelPrincipal') }}" class="btn btn-danger"> Regresar</a>
        </div>
    </form>
</div>
