@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Etiqueta</h1>

        @if (session('success'))
            <div class="alert alert-success col-md-6 m-auto mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger col-md-6 m-auto mt-3">
                <ul style="list-style: none">
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('docentes.tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_tag">Nombre de la Etiqueta:</label>
                <input type="text" name="nombre_tag" id="nombre_tag" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Etiqueta</button>
        </form>
    </div>
@endsection
