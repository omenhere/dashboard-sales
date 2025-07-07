<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $csv = fopen(database_path('seeders/csv/table_product.csv'), 'r');
        fgetcsv($csv); 

        while ($row = fgetcsv($csv)) {
            \App\Models\Product::create([
                'id_product' => $row[0],
                'name_product' => $row[1],
                'harga_materi' => $row[2] === '-' ? 0 : (float) str_replace(',', '', $row[2]),
            ]);
        }

        fclose($csv);
    }
}
