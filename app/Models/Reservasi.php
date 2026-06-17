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

    public function jadwal()
    {
        return $this->belongsTo(
            JadwalPraktek::class,
            'jadwal_id',
            'id_jadwal_praktek'
        );
    }

    public function pasien()
    {
        return $this->belongsTo(
            User::class,
            'pasien_id',
            'id_user'
        );
    }
}
