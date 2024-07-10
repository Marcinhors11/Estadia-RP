<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class AdminBusquedaController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $filter = $request->input('filter');

        if (empty($query)) {
            return redirect()->back()->with('error', 'Debe ingresar un término de búsqueda.');
        }

        $materials = Material::query();

        switch ($filter) {
            case 'autor':
                $materials->whereHas('autor', function ($q) use ($query) {
                    $q->where('nombre_autor', 'like', '%' . $query . '%');
                });
                break;
            case 'docente':
                $materials->whereHas('docente', function ($q) use ($query) {
                    $q->where('nombre_docente', 'like', '%' . $query . '%');
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
                $materials->where('titulo', 'like', '%' . $query . '%');
                break;
        }

        $results = $materials->get();

        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron resultados.');
        }

        return view('admin.contenido.search', compact('results', 'query', 'filter'));
    }
}
