@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materiales Publicados en {{ request()->route('fecha') }}</h1> <!-- Titulo de la vista-->
        @include('errors.alerts')
        <!-- Listar los materiales en la tabla -->
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
                            <!-- Mostrar la imagen del material, en caso de no tener imagen muestra el texto -->
                            @if ($material->imagen)
                                <img src="{{ asset('storage/' . $material->imagen) }}" alt="{{ $material->nombre }}"
                                    style="max-width: 100px;">
                            @else
                                Sin imagen
                            @endif
                        </td>
                        <td class="w-50 p-3" style="text-align: justify;">{{ $material->titulo }}</td> <!-- Titulo del material -->
                        <td>{{ $material->autor->nombre_autor }} {{ $material->autor->apellido_paterno }}
                            {{ $material->autor->apellido_materno }}</td>
                        <td>{{ $material->tipoContenido->nombre_contenido }}</td> <!-- Nombre del autor -->
                        <td>
                            <a href="{{ route('admin.contenido.show', $material->id) }}" class="btn btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
