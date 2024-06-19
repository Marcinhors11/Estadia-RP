@extends('layouts.app')

@section('content')
    <div class="container mt-3 .d-inline-flex ">
        <h1 class="text-center">Registrar Nuevo Material</h1>

        <form
            action="@if (Auth::guard('administrador')->check()) {{ route('admin.materials.store') }}
        @elseif(Auth::guard('docente')->check())
            {{ route('docente.materials.store') }} @endif"
            method="POST" enctype="multipart/form-data" class="justify-content-center">
            @csrf

            <div class="row row-cols-3">
                <!--  Box Title  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}"
                        required>
                </div>

                <!--  Box Autor  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="autor">Autor</label>
                    <select class="form-control" id="autor" name="autor_id" required>
                        <option value="nuevo" class="text-secondary">Seleccionar</option>
                        @foreach ($autores as $autor)
                            <option value="{{ $autor->id }}">{{ $autor->nombre_autor }} {{ $autor->apellido_paterno }}
                                {{ $autor->apellido_materno }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('autores.create') }}" class="btn btn-secondary btn-sm mt-2">Nuevo Autor</a>
                </div>

                <!--  Box Tipo Contenido  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="tipo_contenido">Tipo de Contenido</label>
                    <select name="tipo_contenido_id" id="tipo_contenido" class="form-control" required>
                        <option value="nuevo" class="text-secondary">Seleccionar</option>
                        @foreach ($tipoContenidos as $tipoContenido)
                            <option value="{{ $tipoContenido->id }}">{{ $tipoContenido->nombre_contenido }}</option>
                        @endforeach
                    </select>
                    @if (Auth::guard('administrador')->check())
                        <a href="{{ route('tipo_contenidos.create') }}" class="btn btn-secondary btn-sm mt-2">Nuevo Tipo de
                            Contenido</a>
                    @endif
                </div>

            </div>

            <div class="row">
                <!--  Box Asignatura  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="asignatura">Asignatura</label>
                    <input type="text" class="form-control" id="asignatura" name="asignatura"
                        value="{{ old('asignatura') }}" required>
                </div>

                <!--  Box Tema  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="tema">Tema</label>
                    <input type="text" class="form-control" id="tema" name="tema" value="{{ old('tema') }}"
                        required>
                </div>

                <!--  Box Academia  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="academia">Academia</label>
                    <input type="text" class="form-control" id="academia" name="academia" value="{{ old('academia') }}"
                        required>
                </div>
            </div>

            <div class="row">
                <!--  Box Archivo  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="archivo">Archivo</label>
                    <input type="file" class="form-control-file form-control-sm" id="archivo" name="archivo">
                </div>

                <!--  Box Enlace  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="enlace">Enlace</label>
                    <input type="url" class="form-control" id="enlace" name="enlace" value="{{ old('enlace') }}">
                </div>

                <!--  Box Idioma  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="idioma">Idioma</label>
                    <input type="text" class="form-control" id="idioma" name="idioma" value="{{ old('idioma') }}"
                        required>
                </div>
            </div>

            <div class="row">
                <!--  Box Date  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="fecha_publicacion">Fecha de Publicación</label>
                    <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion"
                        value="{{ old('fecha_publicacion') }}" required>
                </div>

                <!--  Box Description  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                </div>

                <!--  Box Imagen  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control-file form-control-sm" id="imagen" name="imagen">
                </div>
            </div>
    </div>

    <!--  Button Submit  -->
    <div class="d-grid gap-2 col-md-2 col-sm-2 mx-auto">
        <button type="submit" class="btn btn-primary mt-4 mb-5 text-center">Registrar</button>
    </div>
    </form>
    </div>
@endsection
