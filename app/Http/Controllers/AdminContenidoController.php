<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\Academia;
use App\Models\Asignatura;
use App\Models\TipoContenido;
use App\Models\Docente;
use App\Models\Material;

class AdminContenidoController extends Controller
{
    //############################################## Indice Contenido Control ##########################################
    public function indexContenido()
    {
        $autores = Autor::all();
        $academias = Academia::all();
        $asignaturas = Asignatura::all();
        $tiposContenido = TipoContenido::all();
        $docentes = Docente::all();
        $fechasPublicacion = Material::selectRaw('DATE(fecha_publicacion) as fecha')->distinct()->orderBy('fecha', 'desc')->get()->pluck('fecha');

        return view('admin.contenido.index', compact('autores', 'academias', 'asignaturas', 'tiposContenido', 'docentes', 'fechasPublicacion'));
    }

    public function home()
    {
        $autores = Autor::all();
        $academias = Academia::all();
        $asignaturas = Asignatura::all();
        $tiposContenido = TipoContenido::all();
        $docentes = Docente::all();
        $fechasPublicacion = Material::selectRaw('DATE(fecha_publicacion) as fecha')->distinct()->orderBy('fecha', 'desc')->get()->pluck('fecha');

        return view('admin.system.home', compact('autores', 'academias', 'asignaturas', 'tiposContenido', 'docentes', 'fechasPublicacion'));
    }

    public function contenidoPorAutor(Autor $autor)
    {
        $materiales = Material::where('autor_id', $autor->id)->get();
        return view('admin.contenido.lista', compact('materiales', 'autor'));
    }

    public function contenidoPorAcademia(Academia $academia)
    {
        $materiales = Material::where('academia_id', $academia->id)->get();
        return view('admin.contenido.lista', compact('materiales', 'academia'));
    }

    public function contenidoPorAsignatura(Asignatura $asignatura)
    {
        $materiales = Material::where('asignatura_id', $asignatura->id)->get();
        return view('admin.contenido.lista', compact('materiales', 'asignatura'));
    }

    public function contenidoPorTipo(TipoContenido $tipoContenido)
    {
        $materiales = Material::where('tipo_contenido_id', $tipoContenido->id)->get();
        return view('admin.contenido.lista', compact('materiales', 'tipoContenido'));
    }

    public function contenidoPorDocente(Docente $docente)
    {
        $materiales = Material::where('docente_id', $docente->id)->get();
        return view('admin.contenido.lista', compact('materiales', 'docente'));
    }

    public function contenidoPorFecha($fecha)
    {
        $materiales = Material::whereDate('fecha_publicacion', $fecha)->get();
        return view('admin.contenido.materiales', compact('materiales'));
    }

    public function show($id)
    {
        $materiales = Material::with('autor')->findOrFail($id);
        return view('admin.contenido.show', compact('materiales'));
    }
}
