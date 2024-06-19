@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materiales Registrados (Docente)</h1>

        @if (session('success'))
            <div class="alert alert-success col-md-6 m-auto mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger col-md-6 m-auto mt-3">
                <ul style="list-style: none">
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td>{{ $material->titulo }}</td>
                        <td>{{ $material->autor->nombre_autor }} {{ $material->autor->apellido_paterno }} {{ $material->autor->apellido_materno }}</td>
                        <td>
                            <a href="{{ route('docentes.materials.show', $material->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('docentes.materials.edit', $material->id) }}" class="btn btn-warning">Editar</a>
                            @if ($material->solicitudesBaja()->where('pendiente', true)->exists())
                                <span class="badge bg-warning text-dark">Baja pendiente</span>
                            @else
                                <a href="{{ route('docentes.materials.solicitar_baja_form', $material->id) }}"
                                    class="btn btn-danger">Solicitar Baja</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
@endsection
