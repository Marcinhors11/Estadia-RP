<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class DocenteBusquedaController extends Controller
{
    public function search(Request $request)
    {
        // Definir las variables query y filter
        $query = $request->input('query');
        $filter = $request->input('filter');

        // Validar que se ingresa un termino de búsqueda en la barra
        if (empty($query)) {
            return redirect()->back()->with('error', 'Debe ingresar un término de búsqueda.');
        }

        $materials = Material::query();

        // Switch case para los filtros de búsqueda establecidos
        switch ($filter) {
            case 'titulo':
                $materials->whereHas('titulo', function ($q) use ($query) {
                    $q->where('titulo', 'like', '%' . $query . '%');
                });
                break;
            case 'autor':
                $materials->whereHas('autor', function ($q) use ($query) {
                    $q->where('nombre_autor', 'like', '%' . $query . '%')
                        ->orWhere('apellido_paterno', 'like', '%' . $query . '%')
                        ->orWhere('apellido_materno', 'like', '%' . $query . '%');
                });
                break;
            case 'docente':
                $materials->whereHas('docente', function ($q) use ($query) {
                    $q->where('nombre_docente', 'like', '%' . $query . '%')
                        ->orWhere('apellido_paterno', 'like', '%' . $query . '%')
                        ->orWhere('apellido_materno', 'like', '%' . $query . '%');
                });
                break;
            case 'academia':
                $materials->whereHas('academia', function ($q) use ($query) {
                    $q->where('nombre_academia', 'like', '%' . $query . '%');
                });
                break;
            case 'asignatura':
                $materials->whereHas('asignatura', function ($q) use ($query) {
                    $q->where('nombre_asignatura', 'like', '%' . $query . '%');
                });
                break;
            case 'tags':
                $materials->whereHas('tags', function ($q) use ($query) {
                    $q->where('nombre_tag', 'like', '%' . $query . '%');
                });
                break;
            default:
                // Búsqueda general (default) que incluye todos los filtros
                $materials->where('titulo', 'like', '%' . $query . '%')
                    ->orWhereHas('autor', function ($q) use ($query) {
                        $q->where('nombre_autor', 'like', '%' . $query . '%')
                            ->orWhere('apellido_paterno', 'like', '%' . $query . '%')
                            ->orWhere('apellido_materno', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('docente', function ($q) use ($query) {
                        $q->where('nombre_docente', 'like', '%' . $query . '%')
                            ->orWhere('apellido_paterno', 'like', '%' . $query . '%')
                            ->orWhere('apellido_materno', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('academia', function ($q) use ($query) {
                        $q->where('nombre_academia', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('asignatura', function ($q) use ($query) {
                        $q->where('nombre_asignatura', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('tags', function ($q) use ($query) {
                        $q->where('nombre_tag', 'like', '%' . $query . '%');
                    });
                break;
        }

        // Obtener los resultados de busqueda
        $results = $materials->get();

        // Mensaje de error en caso de que la busqueda no exista
        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron resultados.');
        }

        // Redirigir a la página de contenido con los resultados de la busqueda
        return view('docentes.contenido.search', compact('results', 'query', 'filter'));
    }
}
