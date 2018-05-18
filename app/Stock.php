<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [ 'producto_id', 'proveedore_id', 'estado'];

    public function producto(){
        return $this->belongsTo('App\Producto');

    }
}
