@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de la búsqueda</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p class="text-primary">Resultados para "{{ $query }}"</p>

        @if ($results->isNotEmpty())
            <div class="row">
                @foreach ($results as $material)
                    <div class="mb-3" style="max-width: 540px;">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if ($material->imagen)
                                        <img src="{{ asset('storage/' . $material->imagen) }}"
                                            class="img-fluid rounded-start" alt="{{ $material->nombre }}">
                                    @else
                                        Sin imagen
                                    @endif

                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $material->titulo }}</h5>
                                        <p class="card-text">
                                            Autor: {{ $material->autor->nombre_autor ?? ' ' }}
                                            {{ $material->autor->apellido_paterno ?? ' ' }}
                                            {{ $material->autor->apellido_materno ?? ' ' }}<br>
                                            Docente: {{ $material->docente->nombre_docente ?? ' ' }}
                                            {{ $material->docente->apellido_paterno ?? ' ' }}
                                            {{ $material->docente->apellido_materno ?? ' ' }}<br>
                                            Academia: {{ $material->academia->nombre_academia ?? ' ' }}<br>
                                            Asignatura: {{ $material->asignatura->nombre_asignatura ?? ' ' }}<br>
                                            Tipo de Contenido:
                                            {{ $material->tipoContenido->nombre_tipo_contenido ?? ' ' }}<br>
                                            Fecha de Publicación: {{ $material->fecha_publicacion }}
                                        </p>
                                        <a href="{{ route('alumno.contenido.show', $material->id) }}"
                                            class="btn btn-primary">Ver
                                            Material</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No se encontraron resultados.</p>
        @endif
    </div>
@endsection
