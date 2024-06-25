<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DocenteProfileController extends Controller
{
    public function edit()
    {
        $docente = Auth::guard('docente')->user();
        return view('docentes.profile.edit', compact('docente'));
    }

    public function update(Request $request)
    {
        $docente = Auth::guard('docente')->user();

        $rules = [
            'nombre_docente' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $request->validate($rules);

        $docente->nombre_docente = $request->input('nombre_docente');
        $docente->apellido_paterno = $request->input('apellido_paterno');
        $docente->apellido_materno = $request->input('apellido_materno');

        if ($request->filled('password')) {
            $docente->password = Hash::make($request->input('password'));
        }

        $docente->save();

        return redirect()->route('docentes.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
