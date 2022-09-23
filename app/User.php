<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role', 'id_siswa'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function get_siswa(){
        return $this->belongsTo('App\Siswa', 'id_siswa', 'id');
    }

    public function get_pip(){
        return $this->hasMany('App\pip', 'id_user', 'id');
    }
}
