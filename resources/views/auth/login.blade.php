@extends('layouts.index')

@section('content')
    <div class="container mt-3 text-center">
        <h2>Inicio de Sesión</h2>
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
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}" required
                    placeholder="name@example.com" >
                <label for="floatingInput">Correo</label>
            </div>
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Iniciar Sesión</button>
        </form>
        <div class="mt-3">
            <p>¿No tienes una cuenta? Regístrate como:</p>
            <ul style="list-style: none">
                <li><a href="{{ route('alumnos.register') }}">Alumno</a></li>
                <li><a href="{{ route('docentes.register.form') }}">Docente</a></li>
                <li><a href="{{ route('admin.register.form') }}">Directivo</a></li>
            </ul>
        </div>
    </div>
@endsection
