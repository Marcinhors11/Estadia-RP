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
use App\Http\Controllers\DocenteAutorController;
use App\Models\Alumno;

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
    Route::get('repository/inicio', function () {
        return view('alumno.system.home');
    })->name('alumno.system.home');

    Route::get('contenido', [AlumnoController::class, 'indexContenido'])->name('alumno.contenido.index');
    Route::get('contenido/autor/{autor}', [AlumnoController::class, 'contenidoPorAutor'])->name('alumno.contenido.autor');
    Route::get('contenido/academia/{academia}', [AlumnoController::class, 'contenidoPorAcademia'])->name('alumno.contenido.academia');
    Route::get('contenido/asignatura/{asignatura}', [AlumnoController::class, 'contenidoPorAsignatura'])->name('alumno.contenido.asignatura');
    Route::get('contenido/tipo/{tipoContenido}', [AlumnoController::class, 'contenidoPorTipo'])->name('alumno.contenido.tipo');
    Route::get('contenido/docente/{docente}', [AlumnoController::class, 'contenidoPorDocente'])->name('alumno.contenido.docente');
    Route::get('contenido/fecha/{fecha}', [AlumnoController::class, 'contenidoPorFecha'])->name('alumno.contenido.fecha');
    Route::get('contenido/materials/{material}', [AlumnoController::class, 'show'])->name('alumno.contenido.show');
});

// ####################### Rutas Docente #######################
Route::get('docentes/register', [DocenteController::class, 'showRegistrationForm'])->name('docentes.register.form');
Route::post('docentes/register', [DocenteController::class, 'register'])->name('docentes.register');

Route::middleware(['auth:docente'])->group(function () {
    // Rutas protegidas para docente
    Route::get('docente/inicio', function () {
        return view('docentes.system.home');
    })->name('docentes.system.home');

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
});


// ####################### Rutas Admins #######################
Route::get('admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register.form');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register');

Route::middleware(['auth:administrador'])->group(function () {
    Route::get('admin/inicio', function () {
        return view('admin.system.home');
    })->name('admin.system.home');

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
});
