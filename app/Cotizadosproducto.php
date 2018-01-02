<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizadosproducto extends Model
{
    protected $fillable = ['stock_id', 'valor', 'cantidad','cotizacione_id', 'fecha_entrega', 'negocio_id'];
}
