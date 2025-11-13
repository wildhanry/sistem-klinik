<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $fillable = [
        'kunjungan_id',
        'dokter_id',
        'anamnesis',
        'diagnosis',
        'tindakan_medis',
    ];

    /**
     * Get the visit that owns the medical record.
     */
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    /**
     * Get the doctor that created the medical record.
     */
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}
