<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunidade extends Model
{
    protected $fillable = ['descripcion', 'solicitante', 'email', 'cargo', 'telefono', 'empresa', 'nit', 'user_id', 'fecha_requerida', 'fecha_atencion', 'presupuesto', 'observaciones'];
}
