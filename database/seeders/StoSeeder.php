<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class StoSeeder extends Seeder
{
    public function run(): void
    {
        $csv = fopen(database_path('seeders/csv/table_sto.csv'), 'r');
        fgetcsv($csv); // skip header

        while ($row = fgetcsv($csv)) {
            \App\Models\Sto::create([
                'id_sto' => $row[0],    
                'nama_sto' => $row[1],
                'id_witel' => $row[2],
            ]);
        }

        fclose($csv);
    }
}
