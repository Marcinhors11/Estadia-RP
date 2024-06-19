@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Validar Docentes</h2>
        @if (session('success'))
            <div class="alert alert-success col-md-6 m-auto mt-3">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <!-- Muestra mensaje de error si los datos no son correctos -->
            <div class="alert alert-danger col-md-6 m-auto mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                                    <button type="submit" class="btn btn-success">Validar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
