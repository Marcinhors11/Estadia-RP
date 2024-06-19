@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Nuevo Tipo de Contenido</h1>
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
        <form action="{{ route('tipo_contenidos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_contenido">Nombre</label>
                <input type="text" name="nombre_contenido" id="nombre_contenido" class="form-control" required>
                @error('nombre_contenido')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
