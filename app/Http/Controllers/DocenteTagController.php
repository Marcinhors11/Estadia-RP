<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class DocenteTagController extends Controller
{
    public function create()
    {
        return view('docentes.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_tag' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
        ]);

        Tag::create($request->all());

        return redirect()->route('docentes.materials.create')->with('success', 'Etiqueta creada exitosamente');
    }
}
