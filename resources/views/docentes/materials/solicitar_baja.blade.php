@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Solicitar Baja de Material</h1>
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
        <form action="{{ route('docentes.materials.solicitar_baja', $material->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="justificacion">Justificación</label>
                <textarea name="justificacion" id="justificacion" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
        </form>
    </div>
@endsection
