<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'negocio_id', 'tipouser_id'
    ];

    protected $appends = ['tipouser'];

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

    public function getTipouserAttribute(){
        return Tipouser::where('id', $this->tipouser_id)->first();
    }
}
