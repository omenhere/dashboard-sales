<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Witel;
use App\Models\Sto;
use App\Models\Bundle;
use App\Models\Subpaket;
use App\Models\Pricing;

class Khs2Seeder extends Seeder
{
    public function run(): void
    {
        $bundle = Bundle::firstOrCreate(
            ['name' => 'NEW SALES FIBER (SETTING ONLY)'],
            ['id' => Str::uuid()]
        );

        // Ambil atau buat subpaket
        $subpakets = [
            '0P to 1P FO' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => '0P to 1P FO'],
                ['id' => Str::uuid()]
            ),
            '0P to 2P FO' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => '0P to 2P FO'],
                ['id' => Str::uuid()]
            ),
            '0P to 3P FO' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => '0P to 3P FO'],
                ['id' => Str::uuid()]
            ),
            'STB-2' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => 'STB-2'],
                ['id' => Str::uuid()]
            ),
        ];

        // Data langsung di-embed sebagai string
        $rows = <<<DATA
BDG	BDK	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	CCD	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	CJA	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	DGO	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	GGK	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	HGM	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	LBG	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	SMD	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	TAS	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	TLE	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	TRG	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDG	UBR	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	BJA	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	BTJ	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CCL	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CKW	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CLL	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CMI	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CPT	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CSA	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	CWD	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	GNH	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	LEM	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	MJY	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	NJG	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	PDL	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	PNL	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	RCK	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	RJW	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
BDB	SOR	 - 	 66,225 	 - 	 66,225 	 - 	 76,109 	 - 	 76,109 
CBN	AWN	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	BON	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	CBN	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	CKC	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	CKI	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	CKY	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	CLI	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	HAR	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	IMY	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	JBN	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	JTB	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	JTW	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	KAD	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	KNG	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	KRM	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	LOS	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	LSR	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	MJL	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	PAB	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	PRD	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	PTR	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	RGA	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
CBN	SDU	 - 	 40,331 	 - 	 40,331 	 - 	 46,351 	 - 	 46,351 
KWA	CAS	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	CBU	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	CKP	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	CLM	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	CPL	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	JCG	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	JTS	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	KIA	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	KLI	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	KRW	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	PBS	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	PGD	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	PLD	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	PMN	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	PWK	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	RDK	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	SUB	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	TLJ	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
KWA	WDS	 - 	 82,365 	 - 	 82,365 	 - 	 94,658 	 - 	 94,658 
SKB	BGL	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CBD	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CBE	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CCR	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CJG	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CJR	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CKB	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CKK	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	CMO	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	JPK	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	KLU	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	NLD	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	PLR	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	SDL	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	SGA	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	SGN	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	SKB	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	SKM	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
SKB	TGE	 - 	 53,484 	 - 	 53,484 	 - 	 61,467 	 - 	 61,467 
TSM	BJS	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	BNJ	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	CBL	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	CBT	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	CIW	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	CKJ	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	CMS	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	GRU	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	KAW	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	KDN	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	KNU	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	LAG	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	MLB	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	MNJ	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	PAX	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	PMP	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	RJP	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	SPA	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	TSM	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
TSM	WNR	 - 	 41,855 	 - 	 41,855 	 - 	 48,102 	 - 	 48,102 
DATA;

        foreach (explode("\n", trim($rows)) as $line) {
            $cols = preg_split('/\s+/', trim($line));
            if (count($cols) !== 10) continue;

            [$witelName, $stoCode, $m1, $j1, $m2, $j2, $m3, $j3, $m4, $j4] = $cols;

            $witel = Witel::firstOrCreate(
                ['name' => $witelName],
                ['id' => Str::uuid()]
            );

            $sto = Sto::firstOrCreate(
                ['name' => $stoCode],
                ['id' => Str::uuid(), 'witel_id' => $witel->id]
            );

            $prices = [
                '0P to 1P FO' => ['material' => $m1, 'jasa' => $j1],
                '0P to 2P FO' => ['material' => $m2, 'jasa' => $j2],
                '0P to 3P FO' => ['material' => $m3, 'jasa' => $j3],
                'STB-2'       => ['material' => $m4, 'jasa' => $j4],
            ];

            foreach ($prices as $subpaketName => $value) {
                $material = $value['material'] === '-' ? 0 : str_replace(',', '', $value['material']);
                $jasa     = $value['jasa'] === '-' ? 0 : str_replace(',', '', $value['jasa']);


                Pricing::create([
                    'id' => Str::uuid(),
                    'witel_id' => $witel->id,
                    'sto_id' => $sto->id,
                    'subpaket_id' => $subpakets[$subpaketName]->id,
                    'material_price' => $material,
                    'jasa_price' => $jasa,
                ]);
            }
        }
    }
}
