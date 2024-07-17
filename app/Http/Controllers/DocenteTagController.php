<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class DocenteTagController extends Controller
{
    public function create()
    {
        return view('docentes.tags.create'); // Redirigir a la pagina para crear una nueva etiqueta
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_tag' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
        ]);

        // Validar que la etiqueta existe para no duplicar los registros
        $tagExistente = Tag::where('nombre_tag', $request->nombre_tag)
            ->first();

        // Redirigir a la página de materiales con un mensaje de error en caso de que se ya exista un etiqueta
        if ($tagExistente) {
            return redirect()->route('docentes.materials.create')->withInput()->withErrors(['tag_duplicado' => 'La etiqueta ya existe.']);
        }

        // Crear la instancia de las Tags
        Tag::create($request->all());

        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('docentes.materials.create')->with('success', 'Etiqueta creada exitosamente');
    }
}
