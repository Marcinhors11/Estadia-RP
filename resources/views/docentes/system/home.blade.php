@extends('layouts.app')

@section('content')
    <div class="container">
        @include('errors.alerts')
        <div class="mt-3">
            <h1 class="text-center">
                Bienvenido al Repositorio de la División de Ingeniería en
                Tecnologías de la Información</h1>
            <hr class="my-4">
            <p>Aquí podrás encontrar todo el material necesario para tu aprendizaje, desde artículos académicos hasta
                presentaciones y videos. Utiliza las secciones de navegación para explorar el contenido disponible.</p>
        </div>

        <!-- Sección de Contenido -->
        <div class="mt-5 mb-5">
            <h2>Índice de Contenido</h2>
            <hr class="my-4">
            @include('docentes.contenido.index', [
                'autores' => $autores,
                'academias' => $academias,
                'asignaturas' => $asignaturas,
                'tiposContenido' => $tiposContenido,
                'docentes' => $docentes,
                'fechas' => $fechasPublicacion,
            ])
        </div>
    </div>
@endsection
