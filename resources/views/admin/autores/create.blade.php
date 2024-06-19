@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Registrar Nuevo Autor</h1>
        @if (session('success'))
            <div class="alert alert-success col-md-6 m-auto mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger col-md-6 m-auto mt-3">
                <ul style="list-style: none">
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.autores.store') }}" method="POST">
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
