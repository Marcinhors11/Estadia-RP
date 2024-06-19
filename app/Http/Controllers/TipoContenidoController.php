<?php

namespace App\Http\Controllers;

use App\Models\TipoContenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoContenidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrador'); // Middleware para asegurar que solo los administradores puedan acceder
    }

    public function create()
    {
        return view('tipo_contenidos.create');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        TipoContenido::create($request->all());

        return redirect()->route('admin.materials.create')->with('success', 'Tipo de contenido creado con éxito.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_contenido' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
