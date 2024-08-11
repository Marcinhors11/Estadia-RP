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
                        <td class="w-50 p-2" style="text-align: justify;">{{ $solicitud->material->titulo }}</td>
                        <td>{{ $solicitud->docente->nombre_docente }} {{ $solicitud->docente->apellido_paterno }}
                            {{ $solicitud->docente->apellido_materno }}</td>
                        <td>{{ $solicitud->created_at->format('Y-m-d') }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#justificacionModal{{ $solicitud->id }}">
                                <i class="fas fa-eye"></i></a>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('admin.materials.destroy', $solicitud->material->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="justificacionModal{{ $solicitud->id }}" tabindex="-1"
                        aria-labelledby="justificacionModalLabel{{ $solicitud->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="justificacionModalLabel{{ $solicitud->id }}">Justificación
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $solicitud->justificacion }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
