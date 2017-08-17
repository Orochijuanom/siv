<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['descripcion', 'logo', 'nit', 'direccion', 'telefono', 'email', 'negocio_id'];
}
