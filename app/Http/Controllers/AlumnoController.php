<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Academia;
use App\Models\Asignatura;
use App\Models\Material;
use App\Models\Autor;
use App\Models\Docente;
use App\Models\TipoContenido;

class AlumnoController extends Controller
{
    public function showRegistrationForm()
    {
        return view('alumno.register');
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
            'nombre_alumno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_paterno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'apellido_materno' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'matricula' => ['required', 'string', 'max:10', 'unique:alumnos'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:alumnos'],
            'password' => ['required', 'string', 'min:8', 'max:16', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Alumno::create([
            'nombre_alumno' => $data['nombre_alumno'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'matricula' => $data['matricula'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //############################################## Indice Contenido Control ##########################################
    public function indexContenido()
    {
        $autores = Autor::all();
        $academias = Academia::all();
        $asignaturas = Asignatura::all();
        $tiposContenido = TipoContenido::all();
        $docentes = Docente::all();
        $fechas = Material::selectRaw('DATE(created_at) as date')->groupBy('date')->pluck('date');
        return view('alumno.contenido.index', compact('autores', 'academias', 'asignaturas', 'tiposContenido', 'docentes', 'fechas'));
    }

    public function contenidoPorAutor(Autor $autor)
    {
        $materiales = Material::where('autor_id', $autor->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'autor'));
    }

    public function contenidoPorAcademia(Academia $academia)
    {
        $materiales = Material::where('academia_id', $academia->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'academia'));
    }

    public function contenidoPorAsignatura(Asignatura $asignatura)
    {
        $materiales = Material::where('asignatura_id', $asignatura->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'asignatura'));
    }

    public function contenidoPorTipo(TipoContenido $tipoContenido)
    {
        $materiales = Material::where('tipo_contenido_id', $tipoContenido->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'tipoContenido'));
    }

    public function contenidoPorDocente(Docente $docente)
    {
        $materiales = Material::where('docente_id', $docente->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'docente'));
    }

    public function contenidoPorFecha($fecha)
    {
        $materiales = Material::whereDate('created_at', $fecha)->get();
        return view('alumno.contenido.materiales', compact('materiales'));
    }

    public function show($id)
    {
        $materiales = Material::with('autor')->findOrFail($id);
        return view('alumno.contenido.show', compact('materiales'));
    }

    /*
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Iniciar sesión del alumno
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('correo', 'password');

        if (Auth::guard('alumno')->attempt($credentials)) {
            return redirect()->intended('/inicio'); // Cambia '/home' a la ruta que desees
        }

        return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
    }

    // Cerrar sesión del alumno
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('auth.login.form');
    }*/
}
