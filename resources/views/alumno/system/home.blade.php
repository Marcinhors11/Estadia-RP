<!-- resources/views/alumno/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-4 text-center">
                Bienvenido al Repositorio de la División de Ingeniería en
                Tecnologías de la Información</h1>
            <hr class="my-4">
            <p>Aquí podrás encontrar todo el material necesario para tu aprendizaje, desde artículos académicos hasta
                presentaciones y videos. Utiliza las secciones de navegación para explorar el contenido disponible.</p>
        </div>

        <!-- Sección de Contenido Destacado -->

        <div class="mt5">
            <h2>Contenido Destacado</h2>
            <hr class="my-4">
        </div>

        <!-- Sección de Indice de Contenido -->
        <div class="mt-5 mb-5">
            @include('alumno.contenido.index', [
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
