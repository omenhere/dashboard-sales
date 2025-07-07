<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bundling;

class BundlingSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_bundling' => 'b_001', 'name_bundling' => 'KHS New Sales (KU) + Survey'],
            ['id_bundling' => 'b_002', 'name_bundling' => 'NEW SALES FIBER (SETTING ONLY)'],
            ['id_bundling' => 'b_003', 'name_bundling' => 'SERVICE MIGRATION FIBER TO FIBER (SETTING ONLY)'],
        ];

        foreach ($data as $item) {
            Bundling::create($item);
        }
    }
}
