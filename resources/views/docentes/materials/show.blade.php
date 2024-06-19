@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Material</h1>
    <p>Título: {{ $material->titulo }}</p>
    <p>Autor: {{ $material->autor->nombre_autor }} {{ $material->autor->apellido_paterno }} {{ $material->autor->apellido_materno }}</p>
    <!-- Otros campos del material -->
</div>
@endsection
