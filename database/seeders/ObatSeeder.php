<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obats = [
            ['nama_obat' => 'Paracetamol 500mg', 'satuan' => 'tablet', 'stok' => 500, 'harga_jual' => 1000],
            ['nama_obat' => 'Amoxicillin 500mg', 'satuan' => 'kapsul', 'stok' => 300, 'harga_jual' => 3000],
            ['nama_obat' => 'OBH Sirup', 'satuan' => 'botol', 'stok' => 50, 'harga_jual' => 15000],
            ['nama_obat' => 'Vitamin C 1000mg', 'satuan' => 'tablet', 'stok' => 200, 'harga_jual' => 2000],
            ['nama_obat' => 'Antasida', 'satuan' => 'tablet', 'stok' => 150, 'harga_jual' => 1500],
            ['nama_obat' => 'Ibuprofen 400mg', 'satuan' => 'tablet', 'stok' => 250, 'harga_jual' => 2500],
            ['nama_obat' => 'CTM 4mg', 'satuan' => 'tablet', 'stok' => 400, 'harga_jual' => 500],
            ['nama_obat' => 'Salep Luka', 'satuan' => 'tube', 'stok' => 75, 'harga_jual' => 8000],
            ['nama_obat' => 'Antimo', 'satuan' => 'tablet', 'stok' => 100, 'harga_jual' => 3000],
            ['nama_obat' => 'Minyak Kayu Putih', 'satuan' => 'botol', 'stok' => 60, 'harga_jual' => 10000],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}
