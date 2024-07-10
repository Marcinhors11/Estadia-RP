@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Solicitar Baja de Material</h1>
        @include('errors.alerts')
        <form action="{{ route('docentes.materials.solicitar_baja', $material->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="justificacion">Justificación</label>
                <textarea name="justificacion" id="justificacion" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
        </form>
    </div>
@endsection
