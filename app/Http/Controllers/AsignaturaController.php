<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AsignaturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrador'); // Middleware para asegurar que solo los administradores puedan acceder
    }

    public function create()
    {
        return view('asignaturas.create');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Asignatura::create($request->all());

        return redirect()->route('admin.materials.create')->with('success', 'Asignatura creado con éxito.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_asignatura' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
