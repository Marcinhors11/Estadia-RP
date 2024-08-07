@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostrar los mensajes de error -->
        @include('errors.alerts')
        <div class="position-relative">
            <a href="{{ route('alumno.system.home') }}"
                class="btn btn-primary mt-1 mb-4 position-absolute top-0 end-0">Regresar</a>
        </div>
        <h2>
            Materiales de
            @if (isset($autor))
                {{ $autor->nombre_autor }} {{ $autor->apellido_paterno }} {{ $autor->apellido_materno }}
            @elseif(isset($academia))
                {{ $academia->nombre_academia }}
            @elseif(isset($asignatura))
                {{ $asignatura->nombre_asignatura }}
            @elseif(isset($tipoContenido))
                {{ $tipoContenido->nombre_contenido }}
            @elseif(isset($docente))
                {{ $docente->nombre_docente }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
            @else
                {{ $fechas }}
            @endif
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
                        <td>{{ $material->autor->nombre_autor }} {{ $material->autor->apellido_paterno }}
                            {{ $material->autor->apellido_materno }}</td>
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
