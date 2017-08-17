<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacione extends Model
{
    protected $fillable = ['oportunidade_id', 'estatus', 'version', 'moneda_id'];
}
