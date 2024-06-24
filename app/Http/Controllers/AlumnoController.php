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
        return view('alumno.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect()->route('auth.login.form')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    protected function validator(array $data)
    {
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
        return Alumno::create([
            'nombre_alumno' => $data['nombre_alumno'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'matricula' => $data['matricula'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /*
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Iniciar sesión del alumno
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('correo', 'password');

        if (Auth::guard('alumno')->attempt($credentials)) {
            return redirect()->intended('/inicio'); // Cambia '/home' a la ruta que desees
        }

        return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }

    // Cerrar sesión del alumno
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('auth.login.form');
    }*/
}
