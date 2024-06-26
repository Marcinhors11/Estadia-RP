<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_tag' => 'required|string|max:255',
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.create')->with('success', 'Etiqueta creada exitosamente');
    }
}
