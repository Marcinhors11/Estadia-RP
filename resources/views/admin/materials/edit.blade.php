@extends('layouts.app')

@section('content')
    <div class="container mt-3 .d-inline-flex ">
        <h1 class="text-center">Editar Material</h1>

        @include('errors.alerts')

        <form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data"
            class="justify-content-center">
            @csrf

            @method('PUT')

            <div class="row">
                <!--  Box Title  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" class="form-control" id="titulo"
                        value="{{ old('titulo', $material->titulo) }}" required>
                </div>

                <!--  Box Autor  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="autor">Autor</label>
                    <select class="form-control" id="autor" name="autor_id" required>
                        @foreach ($autores as $autor)
                            <option value="{{ $autor->id }}" {{ $autor->id == $material->autor_id ? 'selected' : '' }}>
                                {{ $autor->apellido_paterno }} {{ $autor->apellido_materno }} {{ $autor->nombre_autor }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('admin.autores.create') }}" class="btn btn-secondary btn-sm mt-2">Nuevo Autor</a>
                </div>

                <!--  Box Date  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="fecha_publicacion">Fecha de Publicación</label>
                    <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion"
                        value="{{ old('fecha_publicacion', $material->fecha_publicacion) }}" required>
                </div>
            </div>

            <div class="row">
                <!--  Box Idioma  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="idioma">Idioma</label>
                    <select name="idioma_id" id="idioma" class="form-control" required>
                        @foreach ($idiomas as $idioma)
                            <option value="{{ $idioma->id }}"
                                {{ $idioma->id == $material->idioma_id ? 'selected' : '' }}>
                                {{ $idioma->nombre_idioma }}
                            </option>
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
                        @foreach ($tipoContenidos as $tipoContenido)
                            <option value="{{ $tipoContenido->id }}"
                                {{ $tipoContenido->id == $material->tipo_contenido_id ? 'selected' : '' }}>
                                {{ $tipoContenido->nombre_contenido }}
                            </option>
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
                    <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion', $material->descripcion) }}</textarea>
                </div>
            </div>

            <div class="row">
                <!--  Box Imagen  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="imagen">Imagen Previsualización</label>
                    <input type="file" id="imagen" name="imagen" class="form-control">
                    @if ($material->imagen)
                        <p>Archivo actual: <a href="{{ asset('storage/' . $material->imagen) }}"
                                target="_blank">{{ $material->imagen }}</a></p>
                    @endif
                </div>

                <!--  Box Tema  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="tema">Tema</label>
                    <input type="text" class="form-control" id="tema" name="tema"
                        value="{{ old('tema', $material->tema) }}" required>
                </div>

                <!--  Box Asignatura  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="asignatura">Asignatura</label>
                    <select name="asignatura_id" id="asignatura" class="form-control" required>
                        @foreach ($asignaturas as $asignatura)
                            <option value="{{ $asignatura->id }}"
                                {{ $asignatura->id == $material->asignatura_id ? 'selected' : '' }}>
                                {{ $asignatura->nombre_asignatura }}
                            </option>
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
                        @foreach ($academias as $academia)
                            <option value="{{ $academia->id }}"
                                {{ $academia->id == $material->academia_id ? 'selected' : '' }}>
                                {{ $academia->nombre_academia }}
                            </option>
                        @endforeach
                    </select>
                    @if (Auth::guard('administrador')->check())
                        <a href="{{ route('academias.create') }}" class="btn btn-secondary btn-sm mt-2">Nueva
                            Academia</a>
                    @endif
                </div>

                <!--  Box Archivo  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3" id="archivo-group" style="display:none;">
                    <label for="archivo">Archivo (PDF o Presentación)</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                    @if ($material->archivo)
                        <p>Archivo actual: <a href="{{ asset('storage/' . $material->archivo) }}"
                                target="_blank">{{ $material->archivo }}</a></p>
                    @endif
                </div>


                <!--  Box Enlace  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3" id="enlace-group" style="display:none;">
                    <label for="enlace">Enlace (YouTube)</label>
                    <input type="url" name="enlace" class="form-control" id="enlace"
                        value="{{ old('enlace', $material->enlace) }}">
                </div>

                <!--  Box Etiquetas  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="tags">Etiquetas:</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if($material->tags->contains($tag->id)) selected @endif>
                                {{ $tag->nombre_tag }}
                            </option>
                        @endforeach
                    </select>
                    @if (Auth::guard('docente')->check())
                        <a href="{{ route('docentes.tags.create') }}" class="btn btn-secondary btn-sm mt-2">Crear Nueva
                            Etiqueta</a>
                    @elseif (Auth::guard('administrador')->check())
                        <a href="{{ route('tags.create') }}" class="btn btn-secondary btn-sm mt-2">Crear Nueva
                            Etiqueta</a>
                    @endif
                </div>
            </div>

            <!--  Button Submit  -->
            <div class="d-grid gap-2 col-md-2 col-sm-2 mx-auto">
                <button type="submit" class="btn btn-primary mt-4 mb-5 text-center">Actualizar</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tipoContenido = document.getElementById('tipo_contenido');
            var archivoGroup = document.getElementById('archivo-group');
            var enlaceGroup = document.getElementById('enlace-group');

            function toggleFields() {
                var selectedOption = tipoContenido.options[tipoContenido.selectedIndex].text;
                if (selectedOption === 'PDF' || selectedOption === 'Presentación') {
                    archivoGroup.style.display = 'block';
                    enlaceGroup.style.display = 'none';
                } else if (selectedOption === 'Enlace') {
                    archivoGroup.style.display = 'none';
                    enlaceGroup.style.display = 'block';
                } else {
                    archivoGroup.style.display = 'none';
                    enlaceGroup.style.display = 'none';
                }
            }

            tipoContenido.addEventListener('change', toggleFields);

            // Run on initial load
            toggleFields();

            $(document).ready(function() {
            $('#tags').select2();
        });
        });
    </script>
@endsection
