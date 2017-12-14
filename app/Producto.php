<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Producto extends Model
{
    use FilterPaginateOrder;

    protected $fillable = ['descripcion', 'categoria_id' ,'negocio_id','estado', 'nparte', 'fabricante'];

    protected $filter = ['id', 'descripcion'];
    
    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
