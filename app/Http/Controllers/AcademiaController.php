<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Academia;

class AcademiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrador'); // Middleware para asegurar que solo los administradores puedan acceder
    }

    public function create()
    {
        return view('academias.create');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Academia::create($request->all());

        return redirect()->route('admin.materials.create')->with('success', 'Academia creado con éxito.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_academia' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
        ]);
    }
}
