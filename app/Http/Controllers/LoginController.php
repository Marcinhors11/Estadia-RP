<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
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


        if (Auth::guard('administrador')->attempt($credentials)) {
            return redirect()->intended('admin/inicio');
        } elseif (Auth::guard('docente')->attempt($credentials)) {
            $docente = Auth::guard('docente')->user();
            if ($docente->validado) {
                return redirect()->intended('docente/inicio'); // Ruta del sistema
            } else {
                Auth::guard('docente')->logout();
                return redirect()->back()->withErrors(['correo' => 'Estimado Docente: Le informamos que su cuenta aún no ha sido verificada por los administradores de la División de Ingeniería en Tecnologías de la Información. Le pedimos que tenga paciencia, ya que este proceso de validación puede tomar unos días.
Si tiene alguna pregunta o necesita asistencia adicional, no dude en ponerse en contacto con el equipo de soporte.']);
            }
        } elseif (Auth::guard('alumno')->attempt($credentials)) {
            return redirect()->intended('repository/inicio'); // Ruta del sistema
        }


        return redirect()->back()->withErrors(['correo' => 'Correo o contraseña incorrectos.']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('alumno')->check()) {
            Auth::guard('alumno')->logout();
            return redirect()->route('auth.login.form');
        } elseif (Auth::guard('docente')->check()) {
            Auth::guard('docente')->logout();
            return redirect()->route('auth.login.form');
        } elseif (Auth::guard('administrador')->check()) {
            Auth::guard('administrador')->logout();
            return redirect()->route('auth.login.form');
        }
    }
}
