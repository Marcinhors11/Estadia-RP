@extends('layouts.app')

@section('content')
    <div class="container mt-3 text-center">
        <h1>Editar Perfil</h1>

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

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="nombre_admin" name="nombre_admin" required
                    placeholder="Nombre" value="{{ old('nombre_admin', $admin->nombre_admin) }}">
                <label for="floatingInput">Nombre(s)</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required
                    placeholder="Apellido Paterno" value="{{ old('apellido_paterno', $admin->apellido_paterno) }}">
                <label for="floatingInput">Apellido Paterno</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required
                    placeholder="Apellido Materno" value="{{ old('apellido_materno', $admin->apellido_materno) }}">
                <label for="floatingInput">Apellido Materno</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="email" class="form-control" id="correo" name="correo" required
                    placeholder="name@example.com" value="{{ old('correo', $admin->correo) }}">
                <label for="floatingInput">Correo Electrónico</label>
            </div>

            <div class="form-floating m-auto mt-4 row col-md-4 col-sm-6">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                <label for="floatingInput">Nueva Contraseña</label>
            </div>

            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
                    placeholder="Confirm Password">
                <label for="floatingInput">Confirmar Nueva Contraseña</label>
            </div>

            <button type="submit" class="btn btn-primary mt-4 mb-5">Guardar Cambios</button>
        </form>
    </div>
@endsection
