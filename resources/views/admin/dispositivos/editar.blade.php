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
                {{-- Formulario para guardar un nuevo registro --}}

                @include('admin.dispositivos.formularioEdicion')

            </div>
        </div>
    </div>
@endsection
