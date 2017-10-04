<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Negocio extends Model
{
    use FilterPaginateOrder;
    
    protected $fillable = ['descripcion'];

    protected $filter = ['id', 'descripcion'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
