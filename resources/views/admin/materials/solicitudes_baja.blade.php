{{-- resources/views/admin/materials/solicitudes_baja.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Solicitudes de Baja de Materiales</h1>
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
                                <button type="submit" class="btn btn-danger">Eliminar Material</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
