<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\Academia;
use App\Models\Asignatura;
use App\Models\TipoContenido;
use App\Models\Docente;
use App\Models\Material;

class AlumnoContenidoController extends Controller
{
    //############################################## Indice Contenido Control ##########################################
    public function indexContenido()
    {
        // Obtener todos los datos requeridos
        $autores = Autor::orderBy('apellido_paterno', 'asc')->get();
        $asignaturas = Asignatura::orderBy('nombre_asignatura', 'asc')->get();
        $academias = Academia::orderBy('nombre_academia', 'asc')->get();
        $docentes = Docente::orderBy('apellido_paterno', 'asc')->get();
        $tiposContenido = TipoContenido::all();
        $fechasPublicacion = Material::selectRaw('DATE(fecha_publicacion) as fecha')->distinct()->orderBy('fecha', 'desc')->get()->pluck('fecha');

        // Redirigir a la página de contenido con los datos
        return view('alumno.contenido.index', compact('autores', 'academias', 'asignaturas', 'tiposContenido', 'docentes', 'fechasPublicacion'));
    }

    //############################################## Indice Contenido Control ##########################################
    public function home()
    {
        // Obtener todos los datos requeridos
        $autores = Autor::orderBy('apellido_paterno', 'asc')->get();
        $asignaturas = Asignatura::orderBy('nombre_asignatura', 'asc')->get();
        $academias = Academia::orderBy('nombre_academia', 'asc')->get();
        $docentes = Docente::orderBy('apellido_paterno', 'asc')->get();
        $tiposContenido = TipoContenido::all();
        $fechasPublicacion = Material::selectRaw('DATE(fecha_publicacion) as fecha')->distinct()->orderBy('fecha', 'desc')->get()->pluck('fecha');

        // Redirigir a la página de contenido con los datos
        return view('alumno.system.home', compact('autores', 'academias', 'asignaturas', 'tiposContenido', 'docentes', 'fechasPublicacion'));
    }

    public function contenidoPorAutor(Autor $autor)
    {
        // Obtener los datos de todos los autores y listarlos
        $materiales = Material::where('autor_id', $autor->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'autor'));
    }

    public function contenidoPorAcademia(Academia $academia)
    {
        // Obtener los datos de todas las academias y listarlos
        $materiales = Material::where('academia_id', $academia->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'academia'));
    }

    public function contenidoPorAsignatura(Asignatura $asignatura)
    {
        // Obtener los datos de todos las asignaturas y listarlos
        $materiales = Material::where('asignatura_id', $asignatura->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'asignatura'));
    }

    public function contenidoPorTipo(TipoContenido $tipoContenido)
    {
        // Obtener los datos de todos los tipos de contenido y listarlos
        $materiales = Material::where('tipo_contenido_id', $tipoContenido->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'tipoContenido'));
    }

    public function contenidoPorDocente(Docente $docente)
    {
        // Obtener los datos de todos los docentes y listarlos
        $materiales = Material::where('docente_id', $docente->id)->get();
        return view('alumno.contenido.lista', compact('materiales', 'docente'));
    }

    public function contenidoPorFecha($fecha)
    {
        // Obtener los datos de todos los autores y listarlos
        $materiales = Material::whereDate('fecha_publicacion', $fecha)->get();
        return view('alumno.contenido.materiales', compact('materiales'));
    }

    public function show($id)
    {
        // Obtener los materiales y mostrarlos en la pagina correspondiente
        $materiales = Material::with('autor')->findOrFail($id);
        return view('alumno.contenido.show', compact('materiales'));
    }
}
