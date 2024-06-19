<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DocenteAutorController extends Controller
{
    public function create()
    {
        return view('docentes.autores.create');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Autor::create($request->all());

        return redirect()->route('docentes.materials.index')->with('success', 'Autor registrado exitosamente.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_autor' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
