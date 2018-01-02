<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Oportunidade extends Model
{
    use FilterPaginateOrder;

    protected $fillable = ['descripcion', 'solicitante', 'email', 'cargo', 'telefono', 'empresa', 'nit', 'user_id', 'fecha_requerida', 'fecha_atencion', 'presupuesto', 'observaciones','negocio_id', 'moneda_id'];

    protected $filter = ['id', 'descripcion', 'solicitante', 'email', 'fecha_requerida', 'fecha_atencion', 'user_id'];

    public function cotizaciones(){
        return $this->hasMany('App\Cotizacione');
    }
}
