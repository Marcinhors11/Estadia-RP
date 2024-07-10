<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('administrador')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('administrador')->user();

        $request->validate([
            'nombre_admin' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->nombre_admin = $request->input('nombre_admin');
        $admin->apellido_paterno = $request->input('apellido_paterno');
        $admin->apellido_materno = $request->input('apellido_materno');

        if (Auth::guard('administrador')->check()) {
            $admin->correo = $request->correo;
        }

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
