<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Panggil seeder lainnya di sini
        $this->call([
            WitelSeeder::class,
            StoSeeder::class,
            ProductSeeder::class,
            BundlingSeeder::class,
            ProductBundlingSeeder::class,
            ProductPriceSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
