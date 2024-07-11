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

        // Crear la instancia de las Tags
        Tag::create($request->all());
        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('tags.create')->with('success', 'Etiqueta creada exitosamente');
    }
}
