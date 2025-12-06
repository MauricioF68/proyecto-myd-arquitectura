<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioContacto extends Model
{
    use HasFactory;

    protected $table = 'formularios_contacto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo_solicitante',
        'nombre_completo',
        'numero_celular',
        'correo_electronico',
        'ruc',
        'razon_social',
        'nombre_empresa',
        'mensaje',
        'atendido',
    ];
}