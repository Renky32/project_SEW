<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    //
    protected $table = 'jadwal_praktek';

    protected $primaryKey = 'id_jadwal_praktek';

    public $timestamps = false;
    public function dokter()
    {
        return $this->belongsTo(
            User::class,
            'dokter_id',
            'id_user'
        );
    }
}
