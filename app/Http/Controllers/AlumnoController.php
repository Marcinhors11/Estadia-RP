<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{
    public function showRegistrationForm()
    {
        return view('alumno.register'); // Redirigir a la página de registro de alumnos
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate(); // Verificar que los datos han sido validados

        $this->create($request->all());

        // Redirigir a la página de inicio de sesión con un mensaje de exito
        return redirect()->route('auth.login.form')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    protected function validator(array $data)
    {
        // Validar los datos del formulario
        return Validator::make($data, [
            'nombre_alumno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'matricula' => ['required', 'string', 'max:10', 'unique:alumnos'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:alumnos'],
            'password' => ['required', 'string', 'min:8', 'max:16', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Crear la instancia del alumno
        return Alumno::create([
            'nombre_alumno' => $data['nombre_alumno'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'matricula' => $data['matricula'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
