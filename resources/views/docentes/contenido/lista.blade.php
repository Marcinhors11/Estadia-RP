@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="position-relative">
            <a href="{{ route('docentes.system.home') }}"
                class="btn btn-primary mt-1 mb-4 position-absolute top-0 end-0">Regresar</a>
        </div>
        <h2>Materiales de
            {{ $autor->nombre_autor ?? ($academia->nombre_academia ?? ($asignatura->nombre_asignatura ?? ($tipoContenido->nombre_contenido ?? ($docente->nombre_docente ?? $fechas)))) }}
        </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiales as $material)
                    <tr>
                        <td>
                            @if ($material->imagen)
                                <img src="{{ asset('storage/' . $material->imagen) }}" alt="{{ $material->nombre }}"
                                    style="max-width: 100px;">
                            @else
                                Sin imagen
                            @endif
                        </td>
                        <td class="w-50 p-3" style="text-align: justify;">{{ $material->titulo }}</td>
                        <td>{{ $material->autor->nombre_autor }} {{ $material->autor->apellido_paterno }} {{ $material->autor->apellido_materno }}</td>
                        <td>{{ $material->tipoContenido->nombre_contenido }}</td>
                        <td>
                            <a href="{{ route('docentes.contenido.show', $material->id) }}" class="btn btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
