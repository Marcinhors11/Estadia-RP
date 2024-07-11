<?php

namespace App\Http\Controllers;

//Importar los modelos necesarios
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
        $tipoContenidos = TipoContenido::orderBy('nombre_contenido', 'asc')->get();
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
            'asignatura_id' => 'required|exists:asignaturas,id',
            'tema' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'academia_id' => 'required|exists:academias,id',
            'archivo' => 'nullable|file|mimes:pdf,docx,pptx,xlsx|max:20480',
            'enlace' => 'nullable|url',
            'idioma_id' => 'required|exists:idiomas,id',
            'fecha_publicacion' => 'required|date|before_or_equal:today',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Validar si ya existe un material con el mismo nombre
        $materialExistente = Material::where('titulo', $request->titulo)
            ->first();

        //Si ya existe un material con el mismo nombre retorna un mensaje de error
        if ($materialExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['material_duplicado' => 'El material que intenta registrar ya existe.']);
        }

        //Validar si el imput archivo esta vacio y regresar mensaje de error
        if (!$request->hasFile('archivo') && empty($request->enlace)) {
            return redirect()->back()->withInput()->withErrors(['archivo' => 'Debe subir un archivo o proporcionar un enlace.']);
        }

        //Validar si el usuario ingresa un archivo y enlace en un mismo material y regresar mensaje de error
        if ($request->hasFile('archivo') && !empty($request->enlace)) {
            return redirect()->back()->withInput()->withErrors(['archivo' => 'No puede proporcionar un archivo y un enlace al mismo tiempo.']);
        }

        //Definir como tipo null el nombre del tipo de contenido y la extención del archivo
        $tipo_contenido_nombre = null;
        $fileExtension = null;

        //Validación para asignar el nombre del tipo de contenido dependiendo de la extención del archivo subido
        if ($request->hasFile('archivo')) {
            $fileExtension = $request->file('archivo')->getClientOriginalExtension();

            //Switch case para el tipo de archivo permitido
            switch ($fileExtension) {
                case 'pdf':
                    $tipo_contenido_nombre = 'PDF';
                    break;
                case 'doc':
                case 'docx':
                    $tipo_contenido_nombre = 'Documento';
                    break;
                case 'ppt':
                case 'pptx':
                    $tipo_contenido_nombre = 'Presentación';
                    break;
                case 'xlsx':
                    $tipo_contenido_nombre = 'Excel';
                    break;
                default:
                    return redirect()->back()->withInput()->withErrors(['archivo' => 'Tipo de archivo no soportado.']);
            }
        } elseif (!empty($request->enlace)) { //En caso de que el campo archivo esta vacio el nombre del contenido tiene que ser un enlace
            $tipo_contenido_nombre = 'Enlace';
        }

        //Si la extención del archivo ingresado no coincide con los anteriores retorna un mensaje de error
        if (is_null($tipo_contenido_nombre)) {
            return redirect()->back()->withInput()->withErrors(['tipo_contenido_id' => 'No se pudo determinar el tipo de contenido.']);
        }

        // Verificar si el tipo de contenido ya existe, si no, crearlo
        $tipo_contenido = TipoContenido::firstOrCreate(['nombre_contenido' => $tipo_contenido_nombre]);

        // Crear una nueva instancia del material
        $material = Material::create([
            'titulo' => $request->titulo,
            'autor_id' => $request->autor_id,
            'tipo_contenido_id' => $tipo_contenido->id,
            'asignatura_id' => $request->asignatura_id,
            'tema' => $request->tema,
            'academia_id' => $request->academia_id,
            'idioma_id' => $request->idioma_id,
            'fecha_publicacion' => $request->fecha_publicacion,
            'enlace' => $request->enlace,
            'descripcion' => $request->descripcion,
            'estatus_material' => true, // Estatus por defecto activo
        ]);

        // Manejo del archivo
        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior si existe
            if ($material->archivo) {
                Storage::disk('public')->delete($material->archivo);
            }

            //Guardar el archivo en la carpeta materiales
            $filePath = $request->file('archivo')->store('materiales', 'public');
            $material->archivo = $filePath;
        }

        // Guardar el enlace
        if ($request->filled('enlace')) {
            $material->archivo = $request->enlace;
        }

        //Guardar la Imagen del material
        if ($request->hasFile('imagen')) {
            // Eliminar archivo anterior si existe
            if ($material->imagen) {
                Storage::disk('public')->delete($material->imagen);
            }
            //Guardar la imagen en la carpeta materiales
            $material->imagen = $request->file('imagen')->store('materiales', 'public');
        }

        //Guardar las etiquetas
        if ($request->has('tags')) {
            $material->tags()->attach($request->tags);
        }

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
        //Obtener a todos los autores para mostrarlos en la vista detalles del material
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
        //Validar si un material está pendiente para ser dado de baja
        if ($material->solicitudesBaja()->where('pendiente', true)->exists()) {
            return redirect()->route('docentes.materials.show', $material->id)
                ->with('error', 'Este material tiene una solicitud de baja pendiente y no puede ser editado.');
        }

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
            'asignatura_id' => 'required|exists:asignaturas,id',
            'tema' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'academia_id' => 'required|exists:academias,id',
            'archivo' => 'nullable|file|mimes:pdf,docx,pptx,xlsx|max:20480',
            'enlace' => 'nullable|url',
            'idioma_id' => 'required|exists:idiomas,id',
            'fecha_publicacion' => 'required|date|before_or_equal:today',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Validar si ya existe un material con el mismo nombre
        $materialExistente = Material::where('titulo', $request->titulo)
            ->first();

        //Si ya existe un material con el mismo nombre retorna un mensaje de error
        if ($materialExistente) {
            return redirect()->route('admin.materials.create')->withInput()->withErrors(['material_duplicado' => 'El material que intenta registrar ya existe.']);
        }

        //Validar si el imput archivo esta vacio y regresar mensaje de error
        if (!$request->hasFile('archivo') && empty($request->enlace)) {
            return redirect()->back()->withInput()->withErrors(['archivo' => 'Debe subir un archivo o proporcionar un enlace.']);
        }

        //Validar si el usuario ingresa un archivo y enlace en un mismo material y regresar mensaje de error
        if ($request->hasFile('archivo') && !empty($request->enlace)) {
            return redirect()->back()->withInput()->withErrors(['archivo' => 'No puede proporcionar un archivo y un enlace al mismo tiempo.']);
        }

        //Definir como tipo null el nombre del tipo de contenido y la extención del archivo
        $tipo_contenido_nombre = null;
        $fileExtension = null;

        //Validación para asignar el nombre del tipo de contenido dependiendo de la extención del archivo subido
        if ($request->hasFile('archivo')) {
            $fileExtension = $request->file('archivo')->getClientOriginalExtension();

            //Switch case para el tipo de archivo permitido
            switch ($fileExtension) {
                case 'pdf':
                    $tipo_contenido_nombre = 'PDF';
                    break;
                case 'doc':
                case 'docx':
                    $tipo_contenido_nombre = 'Documento';
                    break;
                case 'ppt':
                case 'pptx':
                    $tipo_contenido_nombre = 'Presentación';
                    break;
                case 'xlsx':
                    $tipo_contenido_nombre = 'Excel';
                    break;
                default:
                    return redirect()->back()->withInput()->withErrors(['archivo' => 'Tipo de archivo no soportado.']);
            }
        } elseif (!empty($request->enlace)) { //En caso de que el campo archivo esta vacio el nombre del contenido tiene que ser un enlace
            $tipo_contenido_nombre = 'Enlace';
        }

        //Si la extención del archivo ingresado no coincide con los anteriores retorna un mensaje de error
        if (is_null($tipo_contenido_nombre)) {
            return redirect()->back()->withInput()->withErrors(['tipo_contenido_id' => 'No se pudo determinar el tipo de contenido.']);
        }

        // Verificar si el tipo de contenido ya existe, si no, crearlo
        $tipo_contenido = TipoContenido::firstOrCreate(['nombre_contenido' => $tipo_contenido_nombre]);

        // Actualizar los campos del material
        $material->update([
            'titulo' => $request->titulo,
            'autor_id' => $request->autor_id,
            'tipo_contenido_id' => $tipo_contenido->id,
            'asignatura_id' => $request->asignatura_id,
            'tema' => $request->tema,
            'academia_id' => $request->academia_id,
            'idioma_id' => $request->idioma_id,
            'fecha_publicacion' => $request->fecha_publicacion,
            'enlace' => $request->enlace,
            'descripcion' => $request->descripcion,
            'estatus_material' => true, // Estatus por defecto activo
        ]);

        // Manejo del archivo
        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior si existe
            if ($material->archivo) {
                Storage::disk('public')->delete($material->archivo);
            }
            //Guardar el archivo en la carpeta materiales
            $filePath = $request->file('archivo')->store('materiales', 'public');
            $material->archivo = $filePath;
        }

        // Guardar el enlace
        if ($request->filled('enlace')) {
            $material->archivo = $request->enlace;
        }

        //Guardar la Imagen del material
        if ($request->hasFile('imagen')) {
            // Eliminar archivo anterior si existe
            if ($material->imagen) {
                Storage::disk('public')->delete($material->imagen);
            }

            $material->imagen = $request->file('imagen')->store('materiales', 'public');
        }

        // Sincroniza las etiquetas
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
        //Obtener los materiales registrados mediante su id, para que se pueda solicitar la baja
        $material = Material::findOrFail($id);
        return view('docentes.materials.solicitar_baja', compact('material'));
    }

    public function solicitarBaja(Request $request, $id)
    {
        //Obtener los materiales mediante el id
        $material = Material::findOrFail($id);

        //Validar los datos del formulario
        $request->validate([
            'justificacion' => 'required|string|max:1000',
        ]);

        // Crear una nueva instancia de la solicitud de baja
        SolicitudBaja::create([
            'material_id' => $material->id,
            'docente_id' => Auth::id(),
            'justificacion' => $request->justificacion,
        ]);

        // Redirigir a la página de materiales con un mensaje de éxito
        return redirect()->route('docentes.materials.index')->with('success', 'Solicitud de baja enviada.');
    }
}
