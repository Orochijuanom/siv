<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;


class Empresa extends Model
{

    use FilterPaginateOrder;
    

    protected $fillable = ['descripcion', 'logo', 'nit', 'direccion', 'telefono', 'email', 'negocio_id'];

    protected $filter = ['id', 'descripcion'];
    
    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }
}

