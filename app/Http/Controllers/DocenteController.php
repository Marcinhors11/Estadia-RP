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
        return view('docentes.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect()->route('auth.login.form')->with('success', '¡Registro exitoso! Para completar el proceso de registro y comenzar a utilizar el sistema, su cuenta deberá ser validada por la Dirección de División de ITI. Este procedimiento asegura que todos nuestros usuarios sean debidamente verificados para mantener la integridad y seguridad del repositorio.');
    }

    protected function validator(array $data)
    {
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
        return Docente::create([
            'nombre_docente' => $data['nombre_docente'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
            'validated' => false, // Default no validado
        ]);
    }

    /*public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('correo', 'password');

        if (Auth::guard('docente')->attempt($credentials)) {
            $docente = Auth::guard('docente')->user();
            if ($docente->validado) {
                return redirect()->intended('docentes/home'); // Cambia '/home' a la ruta que desees
            } else {
                Auth::guard('docente')->logout();
                return redirect()->back()->with('error', 'Tu cuenta aún no ha sido validada por el administrador.');
            }
        }

        return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }

    public function logout()
    {
        Auth::guard('docente')->logout();
        return redirect()->route('auth.login.form');
    }*/
}
