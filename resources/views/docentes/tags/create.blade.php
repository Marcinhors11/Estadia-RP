@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Etiqueta</h1>
        @include('errors.alerts')
        <form action="{{ route('docentes.tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_tag">Nombre de la Etiqueta:</label>
                <input type="text" name="nombre_tag" id="nombre_tag" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Etiqueta</button>
        </form>
    </div>
@endsection
