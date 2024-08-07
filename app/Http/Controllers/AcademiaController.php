<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Academia;

class AcademiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrador'); // Middleware para asegurar que solo los administradores puedan acceder
    }

    public function create()
    {
        return view('academias.create'); // Redirigir a la vista nueva academia
    }

    public function store(Request $request)
    {
        // Verificar que los datos ingresados al formulario esten validados
        $this->validator($request->all())->validate();

        // Validar que la academia existe para no duplicar los registros
        $academiaExistente = Academia::where('nombre_academia', $request->nombre_academia)
            ->first();

        // Redirigir a la página de materiales con un mensaje de error en caso de que se ya exista una academia
        if ($academiaExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['academia_duplicado' => 'La academia ya existe.']);
        }

        // Crear la instancia de la Academia
        Academia::create($request->all());

        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('admin.materials.create')->with('success', 'Academia creado con éxito.');
    }

    protected function validator(array $data)
    {
        // Validar los datos del formulario
        return Validator::make($data, [
            'nombre_academia' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
