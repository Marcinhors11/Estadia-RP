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
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect()->route('auth.login.form')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    protected function validator(array $data)
    {
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
        return Administrador::create([
            'nombre_admin' => $data['nombre_admin'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /* Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('correo', 'password');

        if (Auth::guard('administrador')->attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }
    //logout
    public function logout()
    {
        Auth::guard('administrador')->logout();
        return redirect()->route('auth.login.form');
    }*/

    /* Validación Docentes */

    public function validateDocente($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->validado = true;
        $docente->save();

        return redirect()->route('admin.system.validate-docentes')->with('success', 'Docente validado exitosamente.');
    }
}
