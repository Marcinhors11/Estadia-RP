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

        // Crear la instancia de las Tags
        Tag::create($request->all());
        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('docentes.materials.create')->with('success', 'Etiqueta creada exitosamente');
    }
}
