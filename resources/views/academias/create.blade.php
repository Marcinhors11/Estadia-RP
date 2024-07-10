@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Nueva Acedemia</h1>
        @include('errors.alerts')
        <form action="{{ route('academias.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_academia">Academia</label>
                <input type="text" name="nombre_academia" id="nombre_academia" class="form-control" required>
                @error('nombre_academia')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
