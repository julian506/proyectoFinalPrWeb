@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h3 class="text-center">Catálogo</h3>
			</div>
			<div class="card-body">
                <div class="container">
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($dispositivos as $dispositivo)
                        @if($cont == 1)
                            <div class="row mt-3">
                        @endif
                        <div class="col col-md-4">
                            <div class="card card-productos"  style="height: 100%;">
                                <img src="{{ asset('storage').'/'.$dispositivo->imagen }}" class="card-img-top" style="width: 100%">
                                <div class="card-body d-flex flex-column texto-card">
                                    <h5 class="card-title">{{ $dispositivo->nombre }}</h5>
                                    <p class="card-text">Descripción: {{ $dispositivo->descripcion }}</p>
                                    <p class="card-text">Cantidad disponible: {{ $dispositivo->cantidad }}</p>
                                    <p >Precio en dólares: $<span id = "precioDolares">{{ $dispositivo->precio }}</span></p>
                                    <p class="card-text">Precio en pesos: $ <span id="precioPesos"></span></p>
                                    <form action="{{ route('usuarios.crearVentaUsuario', $dispositivo->id) }}" method="get">
                                        {{-- <input type="text" value = '{{ Session::get('LoggedUser') }}' name="idUsuario" hidden> --}}
                                        <input type="text" value = '{{ $dispositivo->id }}' name="idDispositivo" hidden>
                                        <input type="number" placeholder="Cantidad" name="cantidad" id='cantidadForm2' max="{{ $dispositivo->cantidad }}" min="1" required>
                                        @csrf
                                        <input class="btn btn-success" type="submit" value="Comprar">
                                    </form>
                                    {{-- <a href="{{ route('admin.usuarios.crearVentaUsuario', $dispositivo->i) }}" class="btn btn-success mt-auto" style="width: 100%">Comprar</a> --}}
                                </div>
                            </div>
                        </div>
                        @php
                            $cont += 1;
                        @endphp
                        @if($cont > 3)
                            </div>
                            @php
                                $cont = 1;
                            @endphp
                        @endif
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {!! $dispositivos->links() !!}
                </div>
			</div>
		</div>
	</div>
    <script>
        fetch('https://www.datos.gov.co/resource/32sa-8pi3.json?$limit=10000')
        .then(respuestaAPI => respuestaAPI.json())
        .then(function(datosObtenidos){
            // console.log(datosObtenidos);
            console.log("Valor del dolar hoy: ", datosObtenidos[datosObtenidos.length-1].valor);
            valorDelDolarHoy = parseFloat(datosObtenidos[datosObtenidos.length-1].valor);
            cards = document.getElementsByClassName("texto-card");
            let dolares;
            let pesos;
            // EXPLICACIÓN: Itero por el texto de todas las cards dentro del catálogo
            for(let i = 0; i < cards.length; i++){
                // Obtengo Los hijos, es decir, los elementos que hay dentro de las clases texto-card
                let hijo = cards[i];
                // Por cada hijo, obtengo aquellos elementos que tienen etiqueta span
                spans = hijo.getElementsByTagName("span");
                // Siempre el que se encuentre en la posición 0 corresponderá al que tiene el valor del producto en dólares
                dolares = parseFloat(spans[0].innerText);
                // Siempre el que se encuentre en la posición 1 será aquel que deberá tener el valor en pesos, por lo que lo calculamos
                // y lo ponemos ahí usando innerText
                spans[1].innerText = valorDelDolarHoy * dolares;
            }
        })
    </script>
@endsection
