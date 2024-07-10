{{-- resources/views/admin/materials/solicitudes_baja.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Solicitudes de Baja de Materiales</h1>
        @include('errors.alerts')
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre del Material</th>
                    <th>Nombre del Docente</th>
                    <th>Fecha de Solicitud</th>
                    <th>Justificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudesBaja as $solicitud)
                    <tr>
                        <td>{{ $solicitud->material->titulo }}</td>
                        <td>{{ $solicitud->docente->nombre_docente }} {{ $solicitud->docente->apellido_paterno }}
                            {{ $solicitud->docente->apellido_materno }}</td>
                        <td>{{ $solicitud->created_at }}</td>
                        <td>{{ $solicitud->justificacion }}</td>
                        <td>
                            <form action="{{ route('admin.materials.destroy', $solicitud->material->id) }}" method="POST"
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
