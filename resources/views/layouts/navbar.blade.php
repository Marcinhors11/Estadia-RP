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
                            <a class="dropdown-item" href="{{ route('admin.materials.solicitudes_baja') }}">Baja de
                                materiales</a>
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
                @include('busqueda.bar')
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
                @include('busqueda.bar')
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
            @include('busqueda.bar')
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
        <div class="pe-3">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="fas fa-right-from-bracket px-1"
                        style="cursor: pointer;"></i>Salir</button>
            </form>
        </div>

    </div>

</nav>
