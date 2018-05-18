<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Cliente extends Model
{
    use FilterPaginateOrder;
    
    protected $fillable = ['nombre', 'telefono', 'email', 'nit', 'negocio_id'];

    protected $filter = ['id', 'nombre', 'nit'];
    
    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }
}
