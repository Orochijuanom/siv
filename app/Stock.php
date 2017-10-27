<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['categoria_id', 'producto_id', 'proveedore_id', 'estado', 'valor', 'fecha_entrega', 'forma_entrega'];
}
