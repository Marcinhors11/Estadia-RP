<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;


class AdminAutorController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nombre_autor' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);

        $autorExistente = Autor::where('nombre_autor', $request->nombre_autor)
            ->where('apellido_paterno', $request->apellido_paterno)
            ->where('apellido_materno', $request->apellido_materno)
            ->first();

        if ($autorExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['autor_duplicado' => 'El autor ya existe.']);
        }

        Autor::create([
            'nombre_autor' => $request->nombre_autor,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
        ]);

        return redirect()->route('admin.materials.create')->withInput()->with('success', 'Autor creado exitosamente');
    }
}
