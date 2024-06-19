<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    // Especificar la tabla asociada al modelo
    protected $table = 'autores';

    // Definir los campos que pueden ser llenados masivamente
    protected $fillable = [
        'nombre_autor',
        'apellido_paterno',
        'apellido_materno'
    ];

    public function materiales()
    {
        return $this->hasMany(Material::class, 'autor_id');
    }
}
