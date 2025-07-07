<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductBundlingSeeder extends Seeder
{
    public function run(): void
    {
        $csv = fopen(database_path('seeders/csv/bundling_map.csv'), 'r');
        fgetcsv($csv); // skip header

        while ($row = fgetcsv($csv)) {
            DB::table('product_bundling')->insert([
                'id_product' => $row[0],
                'id_bundling' => $row[1],
            ]);
        }

        fclose($csv);
    }
}
