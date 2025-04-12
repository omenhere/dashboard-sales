<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportWitelSto extends Command {
    protected $signature = 'import:witelsto';
    protected $description = 'Import WITEL & STO dari CSV';

    public function handle() {
        $filePath = storage_path('app/data.csv');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: " . $filePath);
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        array_shift($data); 

        $witels = [];
        $stos = [];

        foreach ($data as $row) {
            [$witel, $sto] = $row;

            if (!isset($witels[$witel])) {
                $witels[$witel] = Str::uuid()->toString();
                DB::table('witels')->insert(['id' => $witels[$witel], 'name' => $witel]);
            }

            $stos[] = [
                'id' => Str::uuid(),
                'witel_id' => $witels[$witel],
                'name' => $sto
            ];
        }

        DB::table('stos')->insert($stos);
        $this->info("Import sukses!");
    }
}
