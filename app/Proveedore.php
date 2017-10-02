<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    protected $fillable = ['nombre', 'empresa', 'telefono', 'email', 'nit', 'negocio_id'];

    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }
}

