<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ProductPrice;

class ProductPriceSeeder extends Seeder
{
    public function run(): void
    {
        $csv = fopen(database_path('seeders/csv/table_pricing.csv'), 'r');
        fgetcsv($csv); // skip header

        while ($row = fgetcsv($csv)) {
            ProductPrice::create([
                'id_product' => $row[0],
                'harga_jasa' => (float) str_replace(',', '', $row[2]),
                'id_witel' => $row[1],
            ]);
        }

        fclose($csv);
    }
}
