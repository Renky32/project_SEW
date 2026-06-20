<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';
    protected $primaryKey = 'id_konsultasi';
    public $timestamps = true;

    protected $fillable = [
        'dokter_id',
        'pasien_id',
        'tanggal_konsultasi',
        'diagnosis',
        'resep_obat',
        'catatan',
        'status'
    ];

    protected $casts = [
        'tanggal_konsultasi' => 'date',
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
}
