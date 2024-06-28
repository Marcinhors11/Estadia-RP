<?php

use App\Http\Controllers\AcademiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMaterialController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\DocenteMaterialController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TipoContenidoController;
use App\Http\Controllers\AdminAutorController;
use App\Http\Controllers\AdminContenidoController;
use App\Http\Controllers\DocenteAutorController;
use App\Http\Controllers\AlumnoContenidoController;
use App\Http\Controllers\AlumnoProfileController;
use App\Http\Controllers\DocenteContenidoController;
use App\Http\Controllers\DocenteProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AlumnoBusquedaController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ####################### Rutas Login #######################
Route::get('repositorio/login', [LoginController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('repositorio/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('repositorio/logout', [LoginController::class, 'logout'])->name('auth.logout');

// ####################### Rutas Alumno #######################
Route::get('alumnos/register', [AlumnoController::class, 'showRegistrationForm'])->name('alumnos.register');
Route::post('alumnos/register', [AlumnoController::class, 'register']);

Route::middleware(['auth:alumno'])->group(function () {
    // Rutas protegidas para alumnos
    Route::get('repository/inicio', [AlumnoContenidoController::class, 'home'])->name('alumno.system.home');

    //Rutas Indice Contenido
    Route::get('alumno/contenido', [AlumnoContenidoController::class, 'indexContenido'])->name('alumno.contenido.index');
    Route::get('alumno/contenido/academia/{academia}', [AlumnoContenidoController::class, 'contenidoPorAcademia'])->name('alumno.contenido.academia');
    Route::get('alumno/contenido/autor/{autor}', [AlumnoContenidoController::class, 'contenidoPorAutor'])->name('alumno.contenido.autor');
    Route::get('alumno/contenido/asignatura/{asignatura}', [AlumnoContenidoController::class, 'contenidoPorAsignatura'])->name('alumno.contenido.asignatura');
    Route::get('alumno/contenido/tipo/{tipoContenido}', [AlumnoContenidoController::class, 'contenidoPorTipo'])->name('alumno.contenido.tipo');
    Route::get('alumno/contenido/docente/{docente}', [AlumnoContenidoController::class, 'contenidoPorDocente'])->name('alumno.contenido.docente');
    Route::get('alumno/contenido/fecha/{fecha}', [AlumnoContenidoController::class, 'contenidoPorFecha'])->name('alumno.contenido.fecha');
    Route::get('alumno/contenido/materials/{material}', [AlumnoContenidoController::class, 'show'])->name('alumno.contenido.show');

    //Rutas Profile
    Route::get('alumno/profile', [AlumnoProfileController::class, 'edit'])->name('alumno.profile.edit');
    Route::put('alumno/profile', [AlumnoProfileController::class, 'update'])->name('alumno.profile.update');

    //Rutas Busqueda
    Route::get('alumno/materials', [AlumnoBusquedaController::class, 'index'])->name('alumno.contenido.search');
    Route::get('alumno/materials/search', [AlumnoBusquedaController::class, 'search'])->name('alumno.contenido.search');
});

// ####################### Rutas Docente #######################
Route::get('docentes/register', [DocenteController::class, 'showRegistrationForm'])->name('docentes.register.form');
Route::post('docentes/register', [DocenteController::class, 'register'])->name('docentes.register');

Route::middleware(['auth:docente'])->group(function () {
    // Rutas protegidas para docente
    Route::get('docente/inicio', [DocenteContenidoController::class, 'home'])->name('docentes.system.home');

    //Rutas Indice Contenido
    Route::get('docente/contenido', [DocenteContenidoController::class, 'indexContenido'])->name('docentes.contenido.index');
    Route::get('docente/contenido/autor/{autor}', [DocenteContenidoController::class, 'contenidoPorAutor'])->name('docentes.contenido.autor');
    Route::get('docente/contenido/academia/{academia}', [DocenteContenidoController::class, 'contenidoPorAcademia'])->name('docentes.contenido.academia');
    Route::get('docente/contenido/asignatura/{asignatura}', [DocenteContenidoController::class, 'contenidoPorAsignatura'])->name('docentes.contenido.asignatura');
    Route::get('docente/contenido/tipo/{tipoContenido}', [DocenteContenidoController::class, 'contenidoPorTipo'])->name('docentes.contenido.tipo');
    Route::get('docente/contenido/docente/{docente}', [DocenteContenidoController::class, 'contenidoPorDocente'])->name('docentes.contenido.docente');
    Route::get('docente/contenido/fecha/{fecha}', [DocenteContenidoController::class, 'contenidoPorFecha'])->name('docentes.contenido.fecha');
    Route::get('docente/contenido/materials/{material}', [DocenteContenidoController::class, 'show'])->name('docentes.contenido.show');

    // Rutas para materiales de docentes
    Route::get('docente/materials', [DocenteMaterialController::class, 'index'])->name('docentes.materials.index');
    Route::get('docente/materials/create', [DocenteMaterialController::class, 'create'])->name('docentes.materials.create');
    Route::post('docente/materials', [DocenteMaterialController::class, 'store'])->name('docentes.materials.store');
    Route::get('docente/materials/{material}', [DocenteMaterialController::class, 'show'])->name('docentes.materials.show');
    Route::get('docente/materials/{material}/edit', [DocenteMaterialController::class, 'edit'])->name('docentes.materials.edit');
    Route::put('docente/materials/{material}', [DocenteMaterialController::class, 'update'])->name('docentes.materials.update');
    Route::delete('docente/materials/{material}', [DocenteMaterialController::class, 'destroy'])->name('docentes.materials.destroy');

    // Rutas de autores
    Route::get('docente/autores/create', [DocenteAutorController::class, 'create'])->name('docentes.autores.create');
    Route::post('docente/autores', [DocenteAutorController::class, 'store'])->name('docentes.autores.store');

    //Rutas baja de material
    Route::get('docente/materials/{material}/solicitar_baja', [DocenteMaterialController::class, 'showSolicitudBajaForm'])->name('docentes.materials.solicitar_baja_form');
    Route::post('docente/materials/{material}/solicitar_baja', [DocenteMaterialController::class, 'solicitarBaja'])->name('docentes.materials.solicitar_baja');

    //Rutas Profile
    Route::get('docente/profile', [DocenteProfileController::class, 'edit'])->name('docentes.profile.edit');
    Route::put('docente/profile', [DocenteProfileController::class, 'update'])->name('docentes.profile.update');
});


// ####################### Rutas Admins #######################
Route::get('admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register.form');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register');

Route::middleware(['auth:administrador'])->group(function () {

    Route::get('admin/inicio', [AdminContenidoController::class, 'home'])->name('admin.system.home');

    //Rutas Indice Contenido
    Route::get('admin/contenido', [AdminContenidoController::class, 'indexContenido'])->name('admin.contenido.index');
    Route::get('admin/contenido/autor/{autor}', [AdminContenidoController::class, 'contenidoPorAutor'])->name('admin.contenido.autor');
    Route::get('admin/contenido/academia/{academia}', [AdminContenidoController::class, 'contenidoPorAcademia'])->name('admin.contenido.academia');
    Route::get('admin/contenido/asignatura/{asignatura}', [AdminContenidoController::class, 'contenidoPorAsignatura'])->name('admin.contenido.asignatura');
    Route::get('admin/contenido/tipo/{tipoContenido}', [AdminContenidoController::class, 'contenidoPorTipo'])->name('admin.contenido.tipo');
    Route::get('admin/contenido/docente/{docente}', [AdminContenidoController::class, 'contenidoPorDocente'])->name('admin.contenido.docente');
    Route::get('admin/contenido/fecha/{fecha}', [AdminContenidoController::class, 'contenidoPorFecha'])->name('admin.contenido.fecha');
    Route::get('admin/contenido/materials/{material}', [AdminContenidoController::class, 'show'])->name('admin.contenido.show');

    //Rutas Validación Docente
    Route::get('admin/validate-docentes', [AdminController::class, 'index'])->name('admin.system.validate-docentes');
    Route::put('admin/validate-docente/{id}', [AdminController::class, 'validateDocente'])->name('admin.system.validate-docente');

    //Rutas Materiales
    Route::get('admin/materials', [AdminMaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('admin/materials/solicitudes_baja', [AdminMaterialController::class, 'solicitudesBaja'])->name('admin.materials.solicitudes_baja');
    Route::get('admin/materials/create', [AdminMaterialController::class, 'create'])->name('admin.materials.create');
    Route::post('admin/materials', [AdminMaterialController::class, 'store'])->name('admin.materials.store');
    Route::get('admin/materials/{material}', [AdminMaterialController::class, 'show'])->name('admin.materials.show');
    Route::get('admin/materials/{material}/edit', [AdminMaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::put('admin/materials/{material}', [AdminMaterialController::class, 'update'])->name('admin.materials.update');
    Route::delete('admin/materials/{material}', [AdminMaterialController::class, 'destroy'])->name('admin.materials.destroy');


    // Rutas de autores
    Route::get('autores/create', [AdminAutorController::class, 'create'])->name('admin.autores.create');
    Route::post('autores', [AdminAutorController::class, 'store'])->name('admin.autores.store');

    //Rutas de contenido
    Route::get('admin/tipoContenido/create', [TipoContenidoController::class, 'create'])->name('tipo_contenidos.create');
    Route::post('admin/tipoContenido', [TipoContenidoController::class, 'store'])->name('tipo_contenidos.store');

    //Rutas de asignatura
    Route::get('admin/asignatura/create', [AsignaturaController::class, 'create'])->name('asignaturas.create');
    Route::post('admin/asignatura', [AsignaturaController::class, 'store'])->name('asignaturas.store');

    //Rutas de idiomas
    Route::get('admin/idioma/create', [IdiomaController::class, 'create'])->name('idiomas.create');
    Route::post('admin/idioma', [IdiomaController::class, 'store'])->name('idiomas.store');

    //Rutas de academia
    Route::get('admin/academia/create', [AcademiaController::class, 'create'])->name('academias.create');
    Route::post('admin/academia', [AcademiaController::class, 'store'])->name('academias.store');

    //Rutas Profile
    Route::get('admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Rutas para etiquetas
    Route::get('admin/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('admin/tags', [TagController::class, 'store'])->name('tags.store');
});
