@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materiales Registrados</h1>

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
                    <th>Subido por</th>
                    <th>Material estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td>{{ $material->titulo }}</td>
                        <td>
                            @if($material->docente)
                                {{ $material->docente->nombre_docente }} {{ $material->docente->apellido_paterno }} {{ $material->docente->apellido_materno }}
                            @elseif($material->administrador)
                                {{ $material->administrador->nombre_admin }} {{ $material->administrador->apellido_paterno }} {{ $material->administrador->apellido_materno }}
                            @endif
                        </td>
                        <td>{{ $material->estatus_material ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <a href="{{ route('admin.materials.show', $material->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('admin.materials.edit', $material->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
