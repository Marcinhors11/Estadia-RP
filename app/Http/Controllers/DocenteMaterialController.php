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
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocenteMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener el docente autenticado
        $user = Auth::guard('docente')->user();
        // Filtrar los materiales por el docente_id del usuario autenticado
        $materials = Material::where('docente_id', $user->id)->with('autor')->get();
        return view('docentes.materials.index', compact('materials'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los autores y tipos de contenido para mostrarlos en el formulario de creación de material
        $autores = Autor::orderBy('apellido_paterno', 'asc')->get();
        $idiomas = Idioma::orderBy('nombre_idioma', 'asc')->get();
        $asignaturas = Asignatura::orderBy('nombre_asignatura', 'asc')->get();
        $academias = Academia::orderBy('nombre_academia', 'asc')->get();
        $tags = Tag::orderBy('nombre_tag', 'asc')->get();
        $tipoContenidos = TipoContenido::all();
        // Pasar ambas variables a la vista
        return view('docentes.materials.create', compact('autores', 'tipoContenidos', 'asignaturas', 'idiomas', 'academias', 'tags'));
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
            'titulo' => 'required|string|max:500',
            'autor_id' => 'required|exists:autores,id',
            'tipo_contenido_id' => 'required|exists:tipo_contenido,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'tema' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'academia_id' => 'required|exists:academias,id',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip',
            'enlace' => 'nullable|url',
            'idioma_id' => 'required|exists:idiomas,id',
            'fecha_publicacion' => 'required|date|before_or_equal:today',
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
        // Manejo del archivo
        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior si existe
            if ($material->archivo) {
                Storage::disk('public')->delete($material->archivo);
            }

            $filePath = $request->file('archivo')->store('materiales', 'public');
            $material->archivo = $filePath;
        }

        // Handle enlace
        if ($request->filled('enlace')) {
            $material->archivo = $request->enlace;
        }

        //Handle Imagen
        if ($request->hasFile('imagen')) {
            // Eliminar archivo anterior si existe
            if ($material->imagen) {
                Storage::disk('public')->delete($material->imagen);
            }

            $material->imagen = $request->file('imagen')->store('materiales', 'public');
        }

        $material->tags()->attach($request->tags);

        // Asignar el ID del usuario autenticado (docente o administrador)
        $material->docente_id = Auth::id(); // O el campo adecuado para el ID del creador


        // Guardar el material en la base de datos
        $material->save();

        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('docentes.materials.index')->with('success', 'Material creado exitosamente.');
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
        return view('docentes.materials.show', compact('material'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        // Obtener todos los autores y tipos de contenido para mostrarlos en el formulario de creación de material
        $autores = Autor::orderBy('apellido_paterno', 'asc')->get();
        $idiomas = Idioma::orderBy('nombre_idioma', 'asc')->get();
        $asignaturas = Asignatura::orderBy('nombre_asignatura', 'asc')->get();
        $academias = Academia::orderBy('nombre_academia', 'asc')->get();
        $tags = Tag::orderBy('nombre_tag', 'asc')->get();
        $tipoContenidos = TipoContenido::all();

        return view('docentes.materials.edit', compact('material', 'autores', 'tipoContenidos', 'asignaturas', 'idiomas', 'academias', 'tags'));
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
            'titulo' => 'required|string|max:500',
            'autor_id' => 'required|exists:autores,id',
            'tipo_contenido_id' => 'required|exists:tipo_contenido,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'tema' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'academia_id' => 'required|exists:academias,id',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip',
            'enlace' => 'nullable|url',
            'idioma_id' => 'required|exists:idiomas,id',
            'fecha_publicacion' => 'required|date|before_or_equal:today',
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
        $material->fecha_publicacion = $request->fecha_publicacion;
        $material->enlace = $request->enlace;
        $material->descripcion = $request->descripcion;
        // Manejo del archivo
        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior si existe
            if ($material->archivo) {
                Storage::disk('public')->delete($material->archivo);
            }

            $filePath = $request->file('archivo')->store('materiales', 'public');
            $material->archivo = $filePath;
        }

        // Handle enlace
        if ($request->filled('enlace')) {
            $material->archivo = $request->enlace;
        }

        //Handle Imagen
        if ($request->hasFile('imagen')) {
            // Eliminar archivo anterior si existe
            if ($material->imagen) {
                Storage::disk('public')->delete($material->imagen);
            }

            $material->imagen = $request->file('imagen')->store('materiales', 'public');
        }

        $material->tags()->sync($request->tags);

        // Guardar los cambios en la base de datos
        $material->save();

        // Redireccionar a la lista de materiales con un mensaje de éxito
        return redirect()->route('docentes.materials.index')->with('success', 'Material actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function showSolicitudBajaForm($id)
    {
        $material = Material::findOrFail($id);
        return view('docentes.materials.solicitar_baja', compact('material'));
    }

    public function solicitarBaja(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'justificacion' => 'required|string|max:1000',
        ]);

        SolicitudBaja::create([
            'material_id' => $material->id,
            'docente_id' => Auth::id(),
            'justificacion' => $request->justificacion,
        ]);

        return redirect()->route('docentes.materials.index')->with('success', 'Solicitud de baja enviada.');
    }
}
