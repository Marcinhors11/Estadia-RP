<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DocenteProfileController extends Controller
{
    public function edit()
    {
        $docente = Auth::guard('docente')->user(); // Obtener los datos del usuario
        return view('docentes.profile.edit', compact('docente'));
    }

    public function update(Request $request)
    {
        $docente = Auth::guard('docente')->user(); // Obtener los datos del usuario

        // Actualizar solo si hay cambios
        $request->validate([
            'nombre_docente' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Obtener el nombre y apellidos del usuario
        $docente->nombre_docente = $request->input('nombre_docente');
        $docente->apellido_paterno = $request->input('apellido_paterno');
        $docente->apellido_materno = $request->input('apellido_materno');

        // Validar que se está cambiando la contraseña para guardar los cambios
        if ($request->filled('password')) {
            $docente->password = Hash::make($request->password);
        }

        $docente->save(); // Guardar los cambios

        return redirect()->route('docentes.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
