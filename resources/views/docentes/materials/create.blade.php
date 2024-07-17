@extends('layouts.app')

@section('content')
    <div class="container mt-3 .d-inline-flex ">
        <h1 class="text-center">Registrar Nuevo Material</h1>

        @include('errors.alerts')

        <form action="{{ route('docentes.materials.store') }}" method="POST" enctype="multipart/form-data"
            class="justify-content-center">
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
                            <option value="{{ $autor->id }}" {{ old('autor_id') == $autor->id ? 'selected' : '' }}>
                                {{ $autor->apellido_paterno }}
                                {{ $autor->apellido_materno }} {{ $autor->nombre_autor }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" data-toggle="modal"
                        data-target="#nuevoAutorModal">
                        Nuevo Autor
                    </button>
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
                            <option value="{{ $idioma->id }}" {{ old('idioma_id') == $idioma->id ? 'selected' : '' }}>
                                {{ $idioma->nombre_idioma }}</option>
                        @endforeach
                    </select>
                </div>

                <!--  Box Description  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                </div>

                <!--  Box Imagen  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="imagen">Imagen/Portada Previsualización</label>
                    <input type="file" id="imagen" name="imagen" class="form-control">
                </div>
            </div>

            <div class="row">
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
                            <option value="{{ $asignatura->id }}"
                                {{ old('asignatura_id') == $asignatura->id ? 'selected' : '' }}>
                                {{ $asignatura->nombre_asignatura }}</option>
                        @endforeach
                    </select>
                </div>

                <!--  Box Academia  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="academia">Academia</label>
                    <select name="academia_id" id="academia" class="form-control" required>
                        <option value="nuevo" class="text-secondary">Seleccionar</option>
                        @foreach ($academias as $academia)
                            <option value="{{ $academia->id }}"
                                {{ old('academia_id') == $academia->id ? 'selected' : '' }}>
                                {{ $academia->nombre_academia }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row">
                <!-- Campo Archivo -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="archivo">Archivo</label>
                    <input type="file" name="archivo" id="archivo" class="form-control"
                        accept=".pdf,.docx,.pptx,.xlsx,.jpg,.png,.jpeg">
                </div>

                <!-- Campo Enlace -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="enlace">Enlace</label>
                    <input type="url" name="enlace" id="enlace" value="{{ old('enlace') }}" class="form-control"
                        placeholder="http://">
                </div>

                <!--  Box Etiquetas  -->
                <div class="form-group col-md-4 m-auto mt-3 p-3">
                    <label for="tags">Etiquetas:</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->nombre_tag }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" data-bs-toggle="modal"
                        data-bs-target="#modalCreateEtiqueta">
                        Nueva Etiqueta
                    </button>
                </div>
            </div>

            <!--  Button Submit  -->
            <div class="d-grid gap-2 col-md-2 col-sm-2 mx-auto">
                <button type="submit" class="btn btn-primary mt-4 mb-5 text-center">Registrar</button>
            </div>
        </form>
    </div>
    <!-- Incluir los modales -->
    @include('docentes.autores.create')
    @include('docentes.tags.create')
@endsection

@section('scripts')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nuevoModal').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
            });
            $('#tags').select2();
        });
    </script>
@endsection
