<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudBaja extends Model
{
    protected $table = 'solicitudes_baja';

    protected $fillable = [
        'material_id',
        'docente_id',
        'justificacion',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
