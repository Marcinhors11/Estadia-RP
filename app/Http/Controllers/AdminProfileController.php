<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('administrador')->user(); // Obtener los datos del usuario
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('administrador')->user();// Obtener los datos del usuario

        // Actualizar solo si hay cambios
        $request->validate([
            'nombre_admin' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Obtener el nombre y apellidos del usuario
        $admin->nombre_admin = $request->input('nombre_admin');
        $admin->apellido_paterno = $request->input('apellido_paterno');
        $admin->apellido_materno = $request->input('apellido_materno');

        // Verificar que el usuario este autenticado para poder cambiar su correo
        if (Auth::guard('administrador')->check()) {
            $admin->correo = $request->correo;
        }

        // Validar que se está cambiando la contraseña para guardar los cambios
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save(); // Guardar los cambios

        return redirect()->route('admin.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
