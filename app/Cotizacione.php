<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacione extends Model
{
    protected $fillable = ['oportunidade_id', 'estado_id', 'version','descuento','showdescuento'];
}
