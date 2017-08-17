<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['descripcion', 'proveedore_id', 'categoria_id', 'negocio_id'];
}
