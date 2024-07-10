@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materiales Registrados</h1>

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
                        <td>
                            @if ($material->docente)
                                {{ $material->docente->nombre_docente }} {{ $material->docente->apellido_paterno }}
                                {{ $material->docente->apellido_materno }}
                            @elseif($material->administrador)
                                {{ $material->administrador->nombre_admin }}
                                {{ $material->administrador->apellido_paterno }}
                                {{ $material->administrador->apellido_materno }}
                            @endif
                        </td>
                        <td class="{{ $material->estatus_material ? 'text-success' : 'text-danger' }}"
                            style="text-align: center;">
                            {{ $material->estatus_material ? 'Activo' : 'Inactivo' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.materials.show', $material->id) }}" class="btn btn-info"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.materials.edit', $material->id) }}" class="btn btn-warning"><i
                                    class="fas fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
