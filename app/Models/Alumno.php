<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Alumno extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nombre_alumno', 'apellido_paterno', 'apellido_materno', 'matricula', 'correo', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
