<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    //
    protected $table = 'reservasi';

    protected $primaryKey = 'id_reservasi';

    public $timestamps = false;

    protected $fillable = [
        'pasien_id',
        'staff_id',
        'jadwal_id',
        'tanggal_booking',
        'nomor_antrian',
        'status_reservasi'
    ];
}
