<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;


    protected $table = 'administradores';


    protected $fillable = [
        'nombre_admin',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
