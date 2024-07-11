<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Docente;

class AdminController extends Controller
{

    public function index()
    {
        // Obtener todos los docentes con el estatus de validación
        $docentes = Docente::all();
        return view('admin.system.validate-docentes', compact('docentes'));
    }

    /* Register */
    public function showRegistrationForm()
    {
        return view('admin.register'); // Redirigir a la página de registro de administradores
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate(); // Verificar que los datos han sido validados
        $this->create($request->all());

        // Redirigir a la página de inicio de sesión con un mensaje de exito
        return redirect()->route('auth.login.form')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    protected function validator(array $data)
    {
        // Validar los datos del formulario
        return Validator::make($data, [
            'nombre_admin' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:administradores'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Crear la instancia del administrador
        return Administrador::create([
            'nombre_admin' => $data['nombre_admin'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /* Validación Docentes */
    public function validateDocente($id)
    {
        $docente = Docente::findOrFail($id); // Obtener todos los docentes mediante el id
        $docente->validado = true; // Validar su registro en el sistema
        $docente->save();
        // Redirigir a la página validar docentes con un mensaje de exito
        return redirect()->route('admin.system.validate-docentes')->with('success', 'Docente validado exitosamente.');
    }
}
