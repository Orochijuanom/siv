<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;


class Categoria extends Model
{
    use FilterPaginateOrder;
    
    protected $fillable = ['descripcion'];

    protected $filter = ['id', 'descripcion'];
}
