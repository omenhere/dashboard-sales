<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $csv = fopen(database_path('seeders/csv/table_sales.csv'), 'r');
        fgetcsv($csv); // skip header

        while ($row = fgetcsv($csv)) {
            Sale::create([
                'id_witel' => $row[0],
                'id_sto' => $row[1],
                'id_product' => $row[2],
                'quantity' => is_numeric($row[3]) ? (int) $row[3] : null,
            ]);
        }

        fclose($csv);
    }
}

