@extends('layouts.app')

@section('content')
    <div class="container mt-3 .d-inline-flex ">
        <h1 class="text-center">Editar Material</h1>

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

        <form
            action="{{ route('docente.materials.store') }}"
            method="POST" enctype="multipart/form-data" class="justify-content-center">
            @csrf

            <div class="row">
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

                <!--  Box Date  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="fecha_publicacion">Fecha de Publicación</label>
                    <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion"
                        value="{{ old('fecha_publicacion') }}" required>
                </div>
            </div>

            <div class="row">
                <!--  Box Idioma  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="idioma">Idioma</label>
                    <select name="idioma_id" id="idioma" class="form-control" required>
                        <option value="nuevo" class="text-secondary">Seleccionar</option>
                        @foreach ($idiomas as $idioma)
                            <option value="{{ $idioma->id }}">{{ $idioma->nombre_idioma }}</option>
                        @endforeach
                    </select>
                    @if (Auth::guard('administrador')->check())
                        <a href="{{ route('idiomas.create') }}" class="btn btn-secondary btn-sm mt-2">Añadir Idioma</a>
                    @endif
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

                <!--  Box Description  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                </div>
            </div>

            <div class="row">
                <!--  Box Imagen  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="imagen">Imagen Previsualización</label>
                    <input type="file" class="form-control-file form-control-sm" id="imagen" name="imagen">
                </div>

                <!--  Box Tema  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="tema">Tema</label>
                    <input type="text" class="form-control" id="tema" name="tema" value="{{ old('tema') }}"
                        required>
                </div>

                <!--  Box Asignatura  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="asignatura">Asignatura</label>
                    <select name="asignatura_id" id="asignatura" class="form-control" required>
                        <option value="nuevo" class="text-secondary">Seleccionar</option>
                        @foreach ($asignaturas as $asignatura)
                            <option value="{{ $asignatura->id }}">{{ $asignatura->nombre_asignatura }}</option>
                        @endforeach
                    </select>
                    @if (Auth::guard('administrador')->check())
                        <a href="{{ route('asignaturas.create') }}" class="btn btn-secondary btn-sm mt-2">Nueva
                            Asignatura</a>
                    @endif
                </div>
            </div>

            <div class="row">
                <!--  Box Academia  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="academia">Academia</label>
                    <select name="academia_id" id="academia" class="form-control" required>
                        <option value="nuevo" class="text-secondary">Seleccionar</option>
                        @foreach ($academias as $academia)
                            <option value="{{ $academia->id }}">{{ $academia->nombre_academia }}</option>
                        @endforeach
                    </select>
                    @if (Auth::guard('administrador')->check())
                        <a href="{{ route('academias.create') }}" class="btn btn-secondary btn-sm mt-2">Nueva
                            Academia</a>
                    @endif
                </div>

                <!--  Box Archivo  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="archivo">Archivo</label>
                    <input type="file" class="form-control-file form-control-sm" id="archivo" name="archivo">
                </div>

                <!--  Box Enlace  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="enlace">Enlace</label>
                    <input type="url" class="form-control" id="enlace" name="enlace"
                        value="{{ old('enlace') }}">
                </div>
            </div>

            <!--  Button Submit  -->
            <div class="d-grid gap-2 col-md-2 col-sm-2 mx-auto">
                <button type="submit" class="btn btn-primary mt-4 mb-5 text-center">Registrar</button>
            </div>
        </form>
    </div>
@endsection
