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
        return view('asignaturas.create'); // Redirigir a la vista nueva asignatura
    }

    public function store(Request $request)
    {
        // Verificar que los datos ingresados al formulario esten validados
        $this->validator($request->all())->validate();
        // Crear la instancia de la Academia
        Asignatura::create($request->all());
        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('admin.materials.create')->with('success', 'Asignatura creado con éxito.');
    }

    protected function validator(array $data)
    {
        // Validar los datos del formulario
        return Validator::make($data, [
            'nombre_asignatura' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
