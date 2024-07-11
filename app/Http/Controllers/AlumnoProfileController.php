<?php

// app/Http/Controllers/AlumnoProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AlumnoProfileController extends Controller
{
    public function edit()
    {
        $alumno = Auth::guard('alumno')->user(); // Obtener los datos del usuario
        return view('alumno.profile.edit', compact('alumno'));
    }

    public function update(Request $request)
    {
        $alumno = Auth::guard('alumno')->user(); // Obtener los datos del usuario

        // Actualizar solo si hay cambios
        $request->validate([
            'nombre_alumno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Obtener el nombre y apellidos del usuario
        $alumno->nombre_alumno = $request->input('nombre_alumno');
        $alumno->apellido_paterno = $request->input('apellido_paterno');
        $alumno->apellido_materno = $request->input('apellido_materno');

        // Verificar que el usuario este autenticado para poder cambiar su correo
        if (Auth::guard('alumno')->check()) {
            $alumno->correo = $request->correo;
        }

        // Validar que se está cambiando la contraseña para guardar los cambios
        if ($request->filled('password')) {
            $alumno->password = Hash::make($request->password);
        }

        $alumno->save(); // Guardar los cambios

        return redirect()->route('alumno.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
