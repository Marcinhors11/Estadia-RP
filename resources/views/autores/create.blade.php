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
        <form action="{{ route('autores.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_autor">Nombre</label>
                <input type="text" class="form-control" id="nombre_autor" name="nombre_autor"
                    value="{{ old('nombre_autor') }}" required>
                @error('nombre_autor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"
                    value="{{ old('apellido_paterno') }}" required>
                @error('nombre_autor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                    value="{{ old('apellido_materno') }}">
                @error('nombre_autor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@endsection
