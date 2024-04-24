<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            ['nama' => 'Produk 1', 'harga' => 100000.00, 'stok' => 10, 'deskripsi' => 'Deskripsi produk 1'],
            ['nama' => 'Produk 2', 'harga' => 200000.00, 'stok' => 20, 'deskripsi' => 'Deskripsi produk 2'],
            // Tambahkan lebih banyak produk sesuai kebutuhan
        ]);
    }
}
