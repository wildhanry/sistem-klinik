<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $fillable = [
        'kunjungan_id',
        'dokter_id',
        'status_resep',
    ];

    /**
     * Get the visit that owns the prescription.
     */
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    /**
     * Get the doctor that created the prescription.
     */
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    /**
     * Get the prescription details for the prescription.
     */
    public function resepDetails()
    {
        return $this->hasMany(ResepDetail::class);
    }
}
