<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WitelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('witels')->insert([
            ['id_witel' => 'w_001', 'nama_witel' => 'BDG'],
            ['id_witel' => 'w_002', 'nama_witel' => 'BDB'],
            ['id_witel' => 'w_003', 'nama_witel' => 'CBN'],
            ['id_witel' => 'w_004', 'nama_witel' => 'KWA'],
            ['id_witel' => 'w_005', 'nama_witel' => 'SKB'],
            ['id_witel' => 'w_006', 'nama_witel' => 'TSM'],
        ]);
    }
}
