<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nisn', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'tempat_lahir', 'date'
    ];

    public function get_user(){
        return $this->hasMany('App\User', 'id_siswa', 'id');
    }
}
