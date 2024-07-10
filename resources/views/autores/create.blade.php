@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Registrar Nuevo Autor</h1>
        @include('errors.alerts')
        <form action="{{ Auth::guard('docente')->check() ? route('docentes.autores.store') : route('admin.autores.store') }}"
            method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_autor">Nombre</label>
                <input type="text" name="nombre_autor" id="nombre_autor" class="form-control"
                    value="{{ old('nombre_autor') }}">
            </div>

            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                    value="{{ old('apellido_paterno') }}">
            </div>

            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                    value="{{ old('apellido_materno') }}">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
