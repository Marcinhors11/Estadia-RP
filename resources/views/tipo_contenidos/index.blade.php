@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tipos de Contenido</h1>
        <a href="{{ route('tipo_contenidos.create') }}" class="btn btn-primary">Agregar Nuevo Tipo de Contenido</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoContenidos as $tipoContenido)
                    <tr>
                        <td>{{ $tipoContenido->id }}</td>
                        <td>{{ $tipoContenido->nombre_contenidos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
