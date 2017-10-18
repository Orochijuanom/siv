<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Support\FilterPaginateOrder;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, FilterPaginateOrder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'negocio_id', 'tipouser_id'
    ];

    protected $filter = ['id', 'name', 'email', 'tipouser_id', 'tipouser.descripcion'];

    protected $appends = ['tipouser', 'estado'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function negocio(){
        return $this->belongsTo('App\Negocio');
    }

    public function tipouser(){
        return $this->belongsTo('App\Tipouser');
    }

    public function getTipouserAttribute(){
        return Tipouser::where('id', $this->tipouser_id)->first();
    }

    public function getEstadoAttribute(){
        if($this->activo == 1){
            return 'Si';
        }else{
            return 'No';
        }
    }
}
