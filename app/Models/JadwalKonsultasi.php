<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKonsultasi extends Model
{
    protected $table = 'jadwal_konsultasi';
    protected $primaryKey = 'id_jadwal_konsultasi';
    public $timestamps = true;

    protected $fillable = [
        'dokter_id',
        'pasien_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keluhan',
        'riwayat_penyakit',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id', 'id');
    }

    public function konsultasi()
    {
        return $this->hasOne(Konsultasi::class, 'jadwal_konsultasi_id', 'id_jadwal_konsultasi');
    }
}
