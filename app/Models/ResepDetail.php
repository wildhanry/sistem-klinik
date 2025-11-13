<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepDetail extends Model
{
    protected $fillable = [
        'resep_id',
        'obat_id',
        'jumlah_obat',
        'aturan_pakai',
    ];

    /**
     * Get the prescription that owns the detail.
     */
    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

    /**
     * Get the medicine for the prescription detail.
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
