<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seleccionadosproducto extends Model
{
    protected $fillable = ['cotizadoproducto_id', 'cotizacione_id', 'valor_venta', 'cantidad', 'fecha_entrega', 'forma_entrega', 'ventaforma_id', 'hasta'];
}
