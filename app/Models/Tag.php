<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_tag'];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_tag');
    }
}
