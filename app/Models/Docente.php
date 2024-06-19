<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Docente extends Authenticatable
{
    use Notifiable;

    protected $guard = 'docente';

    protected $fillable = [
        'nombre_docente',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'password',
        'validado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
