<?php

namespace App\Http\Controllers;

use App\Models\Academia;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Autor;
use App\Models\Idioma;
use App\Models\TipoContenido;
use App\Models\SolicitudBaja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los materiales con las relaciones docente y administrador
        $materials = Material::with('docente', 'administrador', 'autor')->get();
        return view('admin.materials.index', compact('materials'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los autores y tipos de contenido para mostrarlos en el formulario de creación de material
        $autores = Autor::all();
        $tipoContenidos = TipoContenido::all();
        $asignaturas = Asignatura::all();
        $idiomas = Idioma::all();
        $academias = Academia::all();
        // Pasar ambas variables a la vista
        return view('admin.materials.create', compact('autores', 'tipoContenidos', 'asignaturas', 'idiomas', 'academias'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'tipo_contenido_id' => 'required|exists:tipo_contenido,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'tema' => 'required|string|max:255',
            'academia_id' => 'required|exists:academias,id',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip',
            'enlace' => 'nullable|url',
            'idioma_id' => 'required|exists:idiomas,id',
            'fecha_publicacion' => 'required|date',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crear una nueva instancia del material
        $material = new Material();
        $material->titulo = $request->titulo;
        $material->autor_id = $request->autor_id;
        $material->tipo_contenido_id = $request->tipo_contenido_id;
        $material->asignatura_id = $request->asignatura_id;
        $material->tema = $request->tema;
        $material->academia_id = $request->academia_id;
        $material->idioma_id = $request->idioma_id;
        $material->fecha_publicacion = $request->fecha_publicacion;
        $material->enlace = $request->enlace;
        $material->descripcion = $request->descripcion;
        $material->estatus_material = true; // Estatus por defecto activo
        // Handle file upload
        if ($request->hasFile('archivo')) {
            $filePath = $request->file('archivo')->store('materiales', 'public');
            $material->archivo = $filePath;
        }

        // Handle enlace
        if ($request->filled('enlace')) {
            $material->archivo = $request->enlace;
        }

        //Handle Imagen
        if ($request->hasFile('imagen')) {
            $material->imagen = $request->file('imagen')->store('materiales', 'public');
        }

        // Asignar el ID del usuario autenticado (docente o administrador)
        if (Auth::guard('docente')->check()) {
            $material->docente_id = Auth::guard('docente')->id();
        } elseif (Auth::guard('administrador')->check()) {
            $material->admin_id = Auth::guard('administrador')->id();
        }

        // Guardar el material en la base de datos
        $material->save();

        // Redirigir a la página de materiales con un mensaje de éxito
        if (Auth::guard('docente')->check()) {
            return redirect()->route('docente.materials.index')->with('success', 'Material creado exitosamente.');
        } elseif (Auth::guard('administrador')->check()) {
            return redirect()->route('admin.materials.index')->with('success', 'Material creado exitosamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::with('autor')->findOrFail($id);
        return view('admin.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    // Controlador de Material
    public function edit(Material $material)
    {
        // Obtener todos los autores y tipos de contenidos para mostrarlos en el formulario de edición
        $autores = Autor::all();
        $tipoContenidos = TipoContenido::all();
        $asignaturas = Asignatura::all();
        $idiomas = Idioma::all();
        $academias = Academia::all();

        return view('admin.materials.edit', compact('material', 'autores', 'tipoContenidos', 'asignaturas', 'idiomas', 'academias'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'tipo_contenido_id' => 'required|exists:tipo_contenido,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'tema' => 'required|string|max:255',
            'academia_id' => 'required|exists:academias,id',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip',
            'enlace' => 'nullable|url',
            'idioma_id' => 'required|exists:idiomas,id',
            'fecha_publicacion' => 'required|date',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar los campos del material
        $material->titulo = $request->titulo;
        $material->autor_id = $request->autor_id;
        $material->tipo_contenido_id = $request->tipo_contenido_id;
        $material->asignatura_id = $request->asignatura_id;
        $material->tema = $request->tema;
        $material->academia_id = $request->academia_id;
        $material->idioma_id = $request->idioma_id;
        $material->enlace = $request->enlace;
        $material->fecha_publicacion = $request->fecha_publicacion;
        $material->descripcion = $request->descripcion;
        // Handle file upload
        if ($request->hasFile('archivo')) {
            $filePath = $request->file('archivo')->store('materiales', 'public');
            $material->archivo = $filePath;
        }

        // Handle enlace
        if ($request->filled('enlace')) {
            $material->archivo = $request->enlace;
        }

        //Handle Imagen
        if ($request->hasFile('imagen')) {
            $material->imagen = $request->file('imagen')->store('materiales', 'public');
        }

        // Guardar los cambios en la base de datos
        $material->save();

        // Redireccionar a la lista de materiales con un mensaje de éxito
        return redirect()->route('admin.materials.index')->with('success', 'Material actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */

    public function solicitudesBaja()
    {
        $solicitudesBaja = SolicitudBaja::with(['material', 'docente'])->where('pendiente', true)->get();
        return view('admin.materials.solicitudes_baja', compact('solicitudesBaja'));
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        // Eliminar todas las solicitudes de baja relacionadas con este material
        SolicitudBaja::where('material_id', $id)->delete();

        $material->delete(); // Esto ejecutará una eliminación suave

        return redirect()->route('admin.materials.index')->with('success', 'Material eliminado exitosamente.');
    }
}
