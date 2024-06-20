@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Materiales de {{ $autor->nombre_autor ?? $academia->nombre_academia ?? $asignatura->nombre_asignatura ?? $tipoContenido->nombre_contenido ?? $docente->nombre_docente }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiales as $material)
            <tr>
                <td>{{ $material->titulo }}</td>
                <td>{{ $material->tipoContenido->nombre_contenido }}</td>
                <td>
                    <a href="{{ route('alumno.contenido.show', $material->id) }}" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
