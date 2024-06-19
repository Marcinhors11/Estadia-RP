@extends('layouts.index')

@section('content')
    <div class="container mt-3 text-center">
        <div class="position-relative">
            <a href="{{ route('auth.login') }}" class="btn btn-primary mt-1 mb-4 position-absolute top-0 end-0">Regresar</a>
        </div>

        <h2>Registro de Alumnos</h2>
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
        <form action="{{ route('alumnos.register') }}" method="POST">
            @csrf
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" required
                    placeholder="Nombre" value="{{ old('nombre_alumno') }}">
                <label for="floatingInput">Nombre(s)</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required
                    placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}">
                <label for="floatingInput">Apellido Paterno</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required
                    placeholder="Apellido Materno" value="{{ old('apellido_materno') }}">
                <label for="floatingInput">Apellido Materno</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="matricula" name="matricula" required placeholder="Matricula"
                    value="{{ old('matricula') }}">
                <label for="floatingInput">Matrícula</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="email" class="form-control" id="correo" name="correo" required
                    placeholder="name@example.com" value="{{ old('correo') }}">
                <label for="floatingInput">Correo Electrónico</label>
            </div>

            <div class="form-floating m-auto mt-4 row col-md-4 col-sm-6">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                <label for="floatingInput">Contraseña</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
                    placeholder="Confirm Password">
                <label for="floatingInput">Confirmar Contraseña</label>
            </div>

            <button type="submit" class="btn btn-primary mt-4 mb-5">Registrarse</button>
        </form>
    </div>

@endsection
