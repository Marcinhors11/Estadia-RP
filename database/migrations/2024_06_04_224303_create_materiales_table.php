<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->unsignedBigInteger('autor_id');
            $table->text('descripcion')->nullable();
            $table->string('archivo')->nullable();
            $table->string('enlace')->nullable();
            $table->string('imagen')->nullable();
            $table->date('fecha_publicacion');
            $table->string('tema');
            $table->integer('contador_vistas')->default(true);
            $table->boolean('estatus_material')->default(true);

            /* Foreign Keys */
            $table->foreign('autor_id')->references('id')->on('autores')->onDelete('cascade');
            $table->foreignId('docente_id')->nullable()->constrained('docentes');
            $table->foreignId('admin_id')->nullable()->constrained('administradores');
            $table->foreignId('idioma_id')->constrained('idiomas');
            $table->foreignId('asignatura_id')->constrained('asignaturas');
            $table->foreignId('academia_id')->constrained('academias');
            $table->foreignId('tipo_contenido_id')->constrained('tipo_contenido'); // Nueva columna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
