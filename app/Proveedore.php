<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Proveedore extends Model
{
    use FilterPaginateOrder;

    protected $fillable = ['nombre', 'empresa', 'telefono', 'email', 'nit', 'negocio_id'];

    protected $filter = ['id', 'descripcion'];
    
    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }
}

