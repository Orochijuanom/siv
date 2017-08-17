<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizadosproducto extends Model
{
    protected $fillable = ['producto_id', 'proveedore_id', 'valor', 'moneda_id', 'fecha_entrega', 'negocio_id'];
}
