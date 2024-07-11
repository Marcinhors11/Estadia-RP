<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DocenteController extends Controller
{
    public function showRegistrationForm()
    {
        // Redirigir a la página de registro de administradores
        return view('docentes.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate(); // Verificar que los datos han sido validados
        $this->create($request->all());

        // Redirigir a la página de inicio de sesión con un mensaje de exito
        return redirect()->route('auth.login.form')->with('success', '¡Registro exitoso! Para completar el proceso de registro y comenzar a utilizar el sistema, su cuenta deberá ser validada por la Dirección de División de ITI. Este procedimiento asegura que todos nuestros usuarios sean debidamente verificados para mantener la integridad y seguridad del repositorio.');
    }

    protected function validator(array $data)
    {
        // Validar los datos del formulario
        return Validator::make($data, [
            'nombre_docente' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:docentes'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Crear la instancia del administrador
        return Docente::create([
            'nombre_docente' => $data['nombre_docente'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
            'validated' => false, // Default no validado
        ]);
    }
}
