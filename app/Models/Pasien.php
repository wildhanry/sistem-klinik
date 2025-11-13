<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'no_rekam_medis',
        'nama_pasien',
        'no_ktp',
        'tgl_lahir',
        'alamat',
        'no_hp',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    /**
     * Get the visits for the patient.
     */
    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
