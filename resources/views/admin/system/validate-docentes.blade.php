@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Validar Docentes</h2>
        @include('errors.alerts')
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre Docente</th>
                    <th>Correo Institucional</th>
                    <th>Estaus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->nombre_docente }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</td>
                        <td>{{ $docente->correo }}</td>
                        <td>
                            @if ($docente->validado)
                                <span class="text-success">Validado</span>
                            @else
                                <span class="text-warning">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            @if (!$docente->validado)
                                <form action="{{ route('admin.system.validate-docente', $docente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
