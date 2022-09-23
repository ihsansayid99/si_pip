<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class pip extends Model
{
    use AutoNumberTrait;

    protected $fillable = [
        'no_pendaftaran', 'foto_kip', 'keterangan', 'catatan', 'tahun_akademik', 'id_user', 'status'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'no_pendaftaran' => [
                'format' => function () {
                    return 'PIP' . date('Ym') . $this->branch . '/?'; 
                },
                'length' => 5,
            ]
        ];
    }

    public function get_user(){
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
