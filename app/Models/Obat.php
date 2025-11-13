<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'satuan',
        'stok',
        'harga_jual',
    ];

    /**
     * Get the prescription details for the medicine.
     */
    public function resepDetails()
    {
        return $this->hasMany(ResepDetail::class);
    }
}
