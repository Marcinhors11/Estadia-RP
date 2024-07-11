<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;


class AdminAutorController extends Controller
{

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_autor' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
        // Validar que el autor existe para no duplicar los registros
        $autorExistente = Autor::where('nombre_autor', $request->nombre_autor)
            ->where('apellido_paterno', $request->apellido_paterno)
            ->where('apellido_materno', $request->apellido_materno)
            ->first();

        // Redirigir a la página de materiales con un mensaje de error en caso de que se ya exista un autor
        if ($autorExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['autor_duplicado' => 'El autor ya existe.']);
        }

        // Crear una nueva instancia del autor
        Autor::create([
            'nombre_autor' => $request->nombre_autor,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
        ]);

        // Redirigir a la página de materiales con un mensaje de
        return redirect()->route('admin.materials.create')->withInput()->with('success', 'Autor creado exitosamente');
    }
}
