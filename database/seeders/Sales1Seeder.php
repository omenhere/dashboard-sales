<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Witel;
use App\Models\Sto;
use App\Models\Subpaket;
use App\Models\Bundle;
use App\Models\Sale;
use Carbon\Carbon;

class Sales1Seeder extends Seeder
{
    public function run(): void
    {
        $subpaketMap = [
            // Non-setting
            '0P to 1P FO' => '0P to 1P FO',
            '0P to 2P FO' => '0P to 2P FO',
            '0P to 3P FO' => '0P to 3P FO',

            // Setting-only
            '0P to 1P FO SETTING' => '0P to 1P FO SETTING',
            '0P to 2P FO SETTING' => '0P to 2P FO SETTING',
            '0P to 3P FO SETTING' => '0P to 3P FO SETTING',

            // Lainnya
            'STB-2' => 'STB-2',
            '1P FO to 2P FO' => '1P FO to 2P FO',
            '2P FO to 3P FO' => '2P FO to 3P FO',
            '1P FO to 3P FO' => '1P FO to 3P FO',
        ];


        $bundleNames = [
            // Non-setting
            '0P to 1P FO' => 'KHS New Sales (KU) + Survey',
            '0P to 2P FO' => 'KHS New Sales (KU) + Survey',
            '0P to 3P FO' => 'KHS New Sales (KU) + Survey',

            // Setting-only
            '0P to 1P FO SETTING' => 'NEW SALES FIBER (SETTING ONLY)',
            '0P to 2P FO SETTING' => 'NEW SALES FIBER (SETTING ONLY)',
            '0P to 3P FO SETTING' => 'NEW SALES FIBER (SETTING ONLY)',

            // Lainnya
            'STB-2' => 'NEW SALES FIBER (SETTING ONLY)',
            '1P FO to 2P FO' => 'SERVICE MIGRATION FIBER TO FIBER (SETTING ONLY)',
            '2P FO to 3P FO' => 'SERVICE MIGRATION FIBER TO FIBER (SETTING ONLY)',
            '1P FO to 3P FO' => 'SERVICE MIGRATION FIBER TO FIBER (SETTING ONLY)',
        ];

        $data = [
            ['BJS', [36, null, null, null, null, null, null, null, null, null]],
            ['BNJ', [77, 1, null, null, null, null, null, null, null, null]],
            ['CBL', [8, null, null, null, null, null, null, null, null, null]],
            ['CBT', [21, null, null, null, null, null, null, null, null, null]],
            ['CIW', [21, null, null, null, null, null, null, null, null, null]],
            ['CKJ', [19, null, null, null, null, null, null, null, null, null]],
            ['CMS', [97, null, null, null, null, null, 3, 2, null, null]],
            ['GRU', [158, 4, null, null, null, null, 5, 2, null, null]],
            ['KAW', [20, null, null, null, null, null, null, null, null, null]],
            ['KDN', [36, null, null, null, null, null, null, null, null, null]],
            ['KNU', [24, null, null, null, null, null, null, null, null, null]],
            ['LAG', [25, null, null, null, null, null, null, null, null, null]],
            ['MLB', [14, null, null, null, null, null, null, null, null, null]],
            ['MNJ', [23, null, null, null, null, null, 1, null, null, null]],
            ['PAX', [86, null, null, null, null, null, null, 1, null, null]],
            ['PMP', [40, 1, null, null, null, null, null, null, null, null]],
            ['RJP', [27, null, null, null, null, null, null, null, null, null]],
            ['SPA', [46, null, null, null, null, null, 5, 2, null, null]],
            ['TSM', [254, 3, null, null, null, null, 3, null, null, null]],
            ['WNR', [39, 1, null, null, null, null, null, null, null, null]],
        ];
        

        $subpaketKeys = array_keys($subpaketMap);

        foreach ($data as [$stoCode, $amounts]) {
            $witel = Witel::firstOrCreate(['name' => 'TSM'], ['id' => Str::uuid()]);
            $sto = Sto::firstOrCreate(['name' => $stoCode], ['id' => Str::uuid(), 'witel_id' => $witel->id]);

            foreach ($amounts as $index => $qty) {
                if (!$qty)
                    continue;

                $label = $subpaketKeys[$index];
                $subpaketName = $subpaketMap[$label];
                $bundleName = $bundleNames[$subpaketName] ?? null;

                if (!$bundleName)
                    continue;

                $bundle = Bundle::where('name', $bundleName)->first();
                if (!$bundle)
                    continue;

                $subpaket = Subpaket::where('bundle_id', $bundle->id)->where('name', $subpaketName)->first();
                if (!$subpaket)
                    continue;

                Sale::create([
                    'id' => Str::uuid(),
                    'witel_id' => $witel->id,
                    'sto_id' => $sto->id,
                    'subpaket_id' => $subpaket->id,
                    'quantity' => $qty,
                    'sale_date' => now()->toDateString(),
                ]);
            }
        }
    }
}
