<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Proveedore extends Model
{
    use FilterPaginateOrder;

    protected $fillable = ['empresa', 'telefono', 'email', 'nit', 'negocio_id'];

    protected $appends = ['productos'];

    protected $filter = ['id', 'empresa', 'nit'];
    
    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }

    public function getProductosAttribute()
    {
        $productos_id = Stock::where('proveedore_id',$this->id)->pluck('producto_id');
        return Producto::whereIn('id', $productos_id)->with('categoria')->get();

    }
}

