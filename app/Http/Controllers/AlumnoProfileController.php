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
        $alumno = Auth::guard('alumno')->user();
        return view('alumno.profile.edit', compact('alumno'));
    }

    public function update(Request $request)
    {
        $alumno = Auth::guard('alumno')->user();

        // Actualizar solo si hay cambios
        $rules = [
            'nombre_alumno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ];

        if ($request->input('correo') !== $alumno->correo) {
            $rules['correo'] = 'required|string|email|max:255|unique:alumnos';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $request->validate($rules);

        $alumno->nombre_alumno = $request->input('nombre_alumno');
        $alumno->apellido_paterno = $request->input('apellido_paterno');
        $alumno->apellido_materno = $request->input('apellido_materno');

        if ($request->input('correo') !== $alumno->correo) {
            $alumno->correo = $request->input('correo');
        }

        if ($request->filled('password')) {
            $alumno->password = Hash::make($request->input('password'));
        }

        $alumno->save();

        return redirect()->route('alumno.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
