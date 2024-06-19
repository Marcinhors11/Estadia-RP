@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materiales Registrados</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (Auth::guard('administrador')->check())
            <a href="{{ route('admin.materials.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Material</a>
        @elseif (Auth::guard('docente')->check())
            <a href="{{ route('docente.materials.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Material</a>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->titulo }}</td>
                        <td>{{ $material->autor }}</td>
                        <td>
                            @if ($material->material_estatus)
                                Activo
                            @else
                                Baja
                            @endif
                        </td>
                        <td>
                            @if (Auth::guard('administrador')->check())
                                <a href="{{ route('admin.materials.show', $material->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('admin.materials.edit', $material->id) }}"
                                    class="btn btn-warning">Editar</a>
                            @elseif (Auth::guard('docente')->check())
                                <a href="{{ route('docente.materials.show', $material->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('docente.materials.edit', $material->id) }}"
                                    class="btn btn-warning">Editar</a>
                            @endif

                            <form
                                action="@if (Auth::guard('administrador')->check()) {{ route('admin.materials.destroy', $material->id) }}
                                        @elseif(Auth::guard('docente')->check())
                                        {{ route('docente.materials.destroy', $material->id) }} @endif"
                                method="POST" style="display:inline-block;">

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
