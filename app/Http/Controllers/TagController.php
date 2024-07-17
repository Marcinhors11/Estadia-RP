<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create()
    {
        return view('tags.create'); // Redirigir a la pagina para crear una nueva etiqueta
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_tag' => 'required|string|max:255',
        ]);

        // Validar que la etiqueta existe para no duplicar los registros
        $tagExistente = Tag::where('nombre_tag', $request->nombre_tag)
            ->first();

        // Redirigir a la página de materiales con un mensaje de error en caso de que se ya exista un etiqueta
        if ($tagExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['tag_duplicado' => 'La etiqueta ya existe.']);
        }

        // Crear la instancia de las Tags
        Tag::create($request->all());

        // Redirigir a la página de materiales con un mensaje de
        return redirect()->route('admin.materials.create')->withInput()->with('success', 'Etiqueta creada exitosamente');
    }
}
