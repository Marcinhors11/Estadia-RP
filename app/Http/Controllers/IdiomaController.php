<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Idioma;

class IdiomaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrador'); // Middleware para asegurar que solo los administradores puedan acceder
    }

    public function create()
    {
        return view('idiomas.create'); // Redirigir a la pagina para crear un nuevo idioma
    }

    public function store(Request $request)
    {
        // Verificar que los datos ingresados al formulario esten validados
        $this->validator($request->all())->validate();

        // Validar que el idioma existe para no duplicar los registros
        $idiomaExistente = Idioma::where('nombre_idioma', $request->nombre_idioma)
            ->first();

        // Redirigir a la página de materiales con un mensaje de error en caso de que se ya exista un idioma
        if ($idiomaExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['idioma_duplicado' => 'El idioma ya existe.']);
        }

        // Crear la instancia de la Academia
        Idioma::create($request->all());

        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('admin.materials.create')->with('success', 'Idioma creado con éxito.');
    }

    protected function validator(array $data)
    {
        // Validar los datos del formulario
        return Validator::make($data, [
            'nombre_idioma' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
