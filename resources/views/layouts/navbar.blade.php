<nav class="navbar navbar-expand-lg bg-body-tertiary">

    <div class="container-fluid">

        <div class="container-img">
            <a class="navbar-brand" href="#">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLwhSixNsZQCn1i1yVJnASZGLneVdyi-TkvA&s"
                    alt="UPVT" width="100" height="auto">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--  Administrador  -->
        @if (Auth::guard('administrador')->check())
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('admin.system.home') }}">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Materiales
                        </a>
                        <div class="dropdown-menu" aria-labelledby="materialesDropdown">
                            <a class="dropdown-item" href="{{ route('admin.materials.index') }}">Consultar
                                Materiales</a>
                            <a class="dropdown-item" href="{{ route('admin.materials.create') }}">Agregar Nuevo
                                Material</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Bajas de Material
                        </a>
                        <div class="dropdown-menu" aria-labelledby="validarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.materials.solicitudes_baja') }}">Solicitudes
                                de baja de materiales</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Validar Registros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="validarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.system.validate-docentes') }}">Validar
                                Docente</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cuentaDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Editar Perfil</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!--  Docente  -->
        @elseif (Auth::guard('docente')->check())
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('docentes.system.home') }}">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Materiales
                        </a>
                        <div class="dropdown-menu" aria-labelledby="materialesDropdown">
                            <a class="dropdown-item" href="{{ route('docentes.materials.index') }}">Consultar
                                Materiales</a>
                            <a class="dropdown-item" href="{{ route('docentes.materials.create') }}">Agregar Nuevo
                                Material</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cuentaDropdown">
                            <li><a class="dropdown-item" href="{{ route('docentes.profile.edit') }}">Editar Perfil</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

            <!--  Alumno  -->
        @elseif (Auth::guard('alumno')->check())
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('alumno.system.home') }}">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cuentaDropdown">
                            <li><a class="dropdown-item" href="{{ route('alumno.profile.edit') }}">Editar Perfil</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div>
                <!-- Navbar content -->
                <form class="d-flex" action="{{ route('alumno.contenido.search') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar"
                        name="query">
                    <select class="form-select me-2" name="filter">
                        <option value="">Todo</option>
                        <option value="autor">Autor</option>
                        <option value="docente">Docente</option>
                        <option value="academia">Academia</option>
                        <option value="asignatura">Asignatura</option>
                    </select>
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>

            </div>
        @endif

        <!--Usuario-->
        <div class="px-3">
            <i class="fas fa-user"></i>
            <span class="navbar-text">
                @if (Auth::guard('alumno')->check())
                    {{ Auth::guard('alumno')->user()->nombre_alumno }}
                @elseif (Auth::guard('docente')->check())
                    {{ Auth::guard('docente')->user()->nombre_docente }}
                @elseif (Auth::guard('administrador')->check())
                    {{ Auth::guard('administrador')->user()->nombre_admin }}
                @endif
            </span>
        </div>

        <!--Logout-->
        <div class="px-4">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="fas fa-right-from-bracket px-1"
                        style="cursor: pointer;"></i>Salir</button>
            </form>
        </div>

    </div>

</nav>
