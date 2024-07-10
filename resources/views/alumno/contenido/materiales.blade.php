@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostrar los mensajes de error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Materiales Publicados en {{ request()->route('fecha') }}</h1>
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
