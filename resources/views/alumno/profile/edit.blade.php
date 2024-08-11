@extends('layouts.app')

@section('content')
    <div class="container mt-3 text-center">
        <h1>Editar Perfil</h1>

        @include('errors.alerts')

        <form action="{{ route('alumno.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo para Nombre -->
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" required placeholder="Nombre"
                    value="{{ old('nombre_alumno', $alumno->nombre_alumno) }}">
                <label for="floatingInput">Nombre(s)</label>
            </div>

            <!-- Campo para Apellido Paterno -->
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required
                    placeholder="Apellido Paterno" value="{{ old('apellido_paterno', $alumno->apellido_paterno) }}">
                <label for="floatingInput">Apellido Paterno</label>
            </div>

            <!-- Campo para Apellido Materno -->
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required
                    placeholder="Apellido Materno" value="{{ old('apellido_materno', $alumno->apellido_materno) }}">
                <label for="floatingInput">Apellido Materno</label>
            </div>

            <!-- Campo para Correo Electrónico -->
            <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                <input type="email" class="form-control" id="correo" name="correo" required
                    placeholder="name@example.com" value="{{ old('correo', $alumno->correo) }}">
                <label for="floatingInput">Correo Electrónico</label>
            </div>

            <!-- Botón para habilitar la edición de la contraseña -->
            <button type="button" id="changePasswordBtn" class="btn btn-secondary my-4">Cambiar Contraseña</button>

            <!-- Campos de Contraseña, inicialmente ocultos -->
            <div id="passwordFields" style="display: none;">
                <div class="form-floating m-auto row col-md-4 col-sm-6">
                    <input type="password" class="form-control" id="current_password" name="current_password"
                        placeholder="current_password">
                    <label for="floatingInput">Contraseña Actual</label>
                </div>

                <div class="form-floating m-auto mt-4 row col-md-4 col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="floatingInput">Nueva Contraseña</label>
                    <div id="passwordHelpBlock" class="form-text">
                        Tu contraseña debe tener entre 8 y 16 caracteres, contener letras y números, y no debe contener
                        espacios, caracteres especiales ni emojis.
                    </div>
                </div>

                <div class="form-floating m-auto mt-4 col-md-4 col-sm-6">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm Password">
                    <label for="floatingInput">Confirmar Nueva Contraseña</label>
                </div>

            </div>

            <button type="submit" class="btn btn-success my-4">Guardar Cambios</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('changePasswordBtn').addEventListener('click', function() {
            var passwordFields = document.getElementById('passwordFields');
            if (passwordFields.style.display === 'none') {
                passwordFields.style.display = 'block';
            } else {
                passwordFields.style.display = 'none';
            }
        });
    </script>
@endsection
