@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materiales Registrados (Docente)</h1>

        @include('errors.alerts')
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Subido por</th>
                    <th>Material estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td class="w-50 p-3" style="text-align: justify;">{{ $material->titulo }}</td>
                        <td>{{ $material->docente->nombre_docente }} {{ $material->docente->apellido_paterno }}
                            {{ $material->docente->apellido_materno }}</td>
                        <td class="{{ $material->estatus_material ? 'text-success' : 'text-danger' }}"
                            style="text-align: center;">
                            {{ $material->estatus_material ? 'Activo' : 'Inactivo' }}
                        </td>
                        <td>
                            <a href="{{ route('docentes.materials.show', $material->id) }}" class="btn btn-info"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{ route('docentes.materials.edit', $material->id) }}" class="btn btn-warning"><i
                                    class="fas fa-pen-to-square"></i></a>
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
