<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminAutorController extends Controller
{
    public function create()
    {
        return view('admin.autores.create');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Autor::create($request->all());

        return redirect()->route('admin.materials.create')->withInput($request->session()->get('_old_input'))->with('success', 'Autor creado exitosamente');
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
