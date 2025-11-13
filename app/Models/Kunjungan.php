<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $fillable = [
        'pasien_id',
        'tgl_kunjungan',
        'status_kunjungan',
    ];

    protected $casts = [
        'tgl_kunjungan' => 'datetime',
    ];

    /**
     * Get the patient that owns the visit.
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Get the medical record for the visit.
     */
    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class);
    }

    /**
     * Get the prescription for the visit.
     */
    public function resep()
    {
        return $this->hasOne(Resep::class);
    }
}
