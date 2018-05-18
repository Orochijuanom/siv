<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class ClienteContacto extends Model
{
    use FilterPaginateOrder;

    protected $fillable = ['nombres', 'telefono', 'email', 'cargo', 'negocio_id', 'cliente_id'];

    protected $filter = ['nombres', 'cargo'];
}
