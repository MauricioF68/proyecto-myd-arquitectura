<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Proyecto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'estadisticas',
        'tiempo_trabajado',
        'nombre_empresa_cliente',
        'foto_empresa_cliente',
        'notificar_clientes',
    ];
     public function fotos(): HasMany
    {
        return $this->hasMany(ProyectoFoto::class);
    }
}