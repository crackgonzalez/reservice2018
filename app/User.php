<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','rut','email','password','state','account_id','validation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relaciones

    //Un Usuario Pertenece a un Tipo de Cuenta
    public function cuenta(){
       return $this->belongsTo('App\Account','account_id');
    }

    //Una Cuenta de Usuario Pertenece a una Empresa
    public function empresa(){
        return $this->hasOne('App\Company');
    }

    //
    public function cliente(){
        return $this->hasOne('App\Client');
    }

    public function trabajador(){
        return $this->hasOne('App\Employe');
    }

    //Eventos Para el Usuario
    protected $dispatchesEvents = [
        'created' => Events\CrearUsuarioEvent::class,      
    ];
}
