<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'titulo',
        'autor_id',
        'tipo_contenido_id',
        'asignatura_id',
        'tema',
        'academia_id',
        'archivo',
        'enlace',
        'idioma_id',
        'fecha_publicacion',
        'descripcion',
        'imagen',
        'material_estatus',
        'docente_id',
        'admin_id',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function tipoContenido()
    {
        return $this->belongsTo(TipoContenido::class, 'tipo_contenido_id');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignatura_id');
    }

    public function academia()
    {
        return $this->belongsTo(Academia::class, 'academia_id');
    }

    public function idioma()
    {
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function solicitudesBaja()
    {
        return $this->hasMany(SolicitudBaja::class);
    }
}
