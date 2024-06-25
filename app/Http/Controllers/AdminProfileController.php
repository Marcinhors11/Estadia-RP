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

        $rules = [
            'nombre_admin' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $request->validate($rules);

        $admin->nombre_admin = $request->input('nombre_admin');
        $admin->apellido_paterno = $request->input('apellido_paterno');
        $admin->apellido_materno = $request->input('apellido_materno');

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
