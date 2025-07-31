<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre_usuario',
        'correo_electronico',
        'numero_telefono',
        'fecha_nacimiento',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token', // solo si realmente existe en la tabla
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_registro' => 'datetime',
    ];

    public $timestamps = false;

    const CREATED_AT = 'fecha_registro'; // Está bien
    // Elimina esta línea porque es inválida
    // const UPDATED_AT = null;

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthIdentifierName()
    {
        return 'nombre_usuario'; // Cambia por 'correo_electronico' si tu login usa correo.
    }
}
