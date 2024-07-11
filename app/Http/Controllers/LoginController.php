<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Redirigir a la página de inicio de sesión
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario para iniciar sesión
        $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('correo', 'password'); // Almacenar las credenciales del usuario para determinar su rol


        if (Auth::guard('administrador')->attempt($credentials)) { // Validar las credenciales del administrador y redirigirlo al CRUD Admin
            return redirect()->intended('admin/inicio');
        } elseif (Auth::guard('docente')->attempt($credentials)) { // Validar las credenciales del docente y redirigirlo al CRUD docente
            $docente = Auth::guard('docente')->user();
            if ($docente->validado) { // Verificar que el docente esta validado para ingresar al sistema
                return redirect()->intended('docente/inicio'); // Ruta del sistema
            } else {
                Auth::guard('docente')->logout(); // En caso de que el docente no este validado lo redirige a el inicio de sesión y muestra un mensaje de error
                return redirect()->back()->withErrors(['correo' => 'Estimado Docente: Le informamos que su cuenta aún no ha sido verificada por los administradores de la División de Ingeniería en Tecnologías de la Información. Le pedimos que tenga paciencia, ya que este proceso de validación puede tomar unos días.
Si tiene alguna pregunta o necesita asistencia adicional, no dude en ponerse en contacto con el equipo de soporte.']);
            }
        } elseif (Auth::guard('alumno')->attempt($credentials)) { // Validar las credenciales del alumno y redirigirlo al sistema
            return redirect()->intended('repository/inicio'); // Ruta del sistema
        }

        // Validar las credenciales del usuario y si no son correctas muestra un mensaje de error
        return redirect()->back()->withErrors(['correo' => 'Correo o contraseña incorrectos.']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('alumno')->check()) { // Validar al usuario autenticado para cerrar sesión y lo redirije al inicio de sesión
            Auth::guard('alumno')->logout();
            return redirect()->route('auth.login.form');
        } elseif (Auth::guard('docente')->check()) { // Validar al usuario autenticado para cerrar sesión y lo redirije al inicio de sesión
            Auth::guard('docente')->logout();
            return redirect()->route('auth.login.form');
        } elseif (Auth::guard('administrador')->check()) { // Validar al usuario autenticado para cerrar sesión y lo redirije al inicio de sesión
            Auth::guard('administrador')->logout();
            return redirect()->route('auth.login.form');
        }
    }
}
