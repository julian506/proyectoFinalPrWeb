@extends('layouts.appAdmin')

@section('content')
    <div class="container">
        {{-- Acá se obtiene el mensaje de éxito enviado desde DispositivoController --}}
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Acá se obtiene el mensaje de fracaso enviado desde DispositivoController --}}
        @if (Session::get('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Panel de administrador</h3>
            </div>
            <div class="card-body">
                <h3 class="text-center"> N° Dispositivos: {{ count($dispositivos) }}</h3>
                @include('admin/dispositivos.datatable')
            </div>
        </div>
    </div>
@endsection
