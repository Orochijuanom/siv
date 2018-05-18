<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class ProveedorContacto extends Model
{
    use FilterPaginateOrder;

    protected $fillable = ['nombres', 'telefono', 'email', 'cargo', 'negocio_id', 'proveedore_id'];

    protected $filter = ['nombres', 'cargo'];
}
