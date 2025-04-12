<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Witel;
use App\Models\Sto;
use App\Models\Bundle;
use App\Models\Subpaket;
use App\Models\Pricing;

class Khs3Seeder extends Seeder
{
    public function run(): void
    {
        $bundle = Bundle::firstOrCreate(
            ['name' => 'SERVICE MIGRATION FIBER TO FIBER (SETTING ONLY)'],
            ['id' => Str::uuid()]
        );

        $subpakets = [
            '1P FO to 2P FO' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => '1P FO to 2P FO'],
                ['id' => Str::uuid()]
            ),
            '2P FO to 3P FO' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => '2P FO to 3P FO'],
                ['id' => Str::uuid()]
            ),
            '1P FO to 3P FO' => Subpaket::firstOrCreate(
                ['bundle_id' => $bundle->id, 'name' => '1P FO to 3P FO'],
                ['id' => Str::uuid()]
            ),
        ];

        $rows = <<<DATA
BDG	BDK	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	CCD	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	CJA	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	DGO	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	GGK	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	HGM	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	LBG	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	SMD	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	TAS	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	TLE	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	TRG	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDG	UBR	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	BJA	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	BTJ	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CCL	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CKW	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CLL	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CMI	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CPT	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CSA	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	CWD	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	GNH	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	LEM	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	MJY	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	NJG	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	PDL	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	PNL	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	RCK	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	RJW	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
BDB	SOR	 - 	 34,640 	 - 	 34,640 	 - 	 57,733 
CBN	AWN	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	BON	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	CBN	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	CKC	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	CKI	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	CKY	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	CLI	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	HAR	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	IMY	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	JBN	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	JTB	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	JTW	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	KAD	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	KNG	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	KRM	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	LOS	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	LSR	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	MJL	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	PAB	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	PRD	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	PTR	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	RGA	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
CBN	SDU	 - 	 23,046 	 - 	 23,046 	 - 	 38,410 
KWA	CAS	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	CBU	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	CKP	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	CLM	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	CPL	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	JCG	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	JTS	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	KIA	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	KLI	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	KRW	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	PBS	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	PGD	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	PLD	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	PMN	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	PWK	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	RDK	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	SUB	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	TLJ	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
KWA	WDS	 - 	 41,629 	 - 	 41,629 	 - 	 69,382 
SKB	BGL	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CBD	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CBE	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CCR	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CJG	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CJR	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CKB	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CKK	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	CMO	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	JPK	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	KLU	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	NLD	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	PLR	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	SDL	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	SGA	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	SGN	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	SKB	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	SKM	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
SKB	TGE	 - 	 28,935 	 - 	 28,935 	 - 	 48,225 
TSM	BJS	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	BNJ	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	CBL	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	CBT	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	CIW	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	CKJ	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	CMS	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	GRU	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	KAW	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	KDN	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	KNU	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	LAG	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	MLB	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	MNJ	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	PAX	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	PMP	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	RJP	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	SPA	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	TSM	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
TSM	WNR	 - 	 23,776 	 - 	 23,776 	 - 	 39,626 
DATA;

        foreach (explode("\n", trim($rows)) as $line) {
            $cols = preg_split('/\s+/', trim($line));
            if (count($cols) !== 8) continue;

            [$witelName, $stoCode, $m1, $j1, $m2, $j2, $m3, $j3] = $cols;

            $witel = Witel::firstOrCreate(
                ['name' => $witelName],
                ['id' => Str::uuid()]
            );

            $sto = Sto::firstOrCreate(
                ['name' => $stoCode],
                ['id' => Str::uuid(), 'witel_id' => $witel->id]
            );

            $prices = [
                '1P FO to 2P FO' => ['material' => $m1, 'jasa' => $j1],
                '2P FO to 3P FO' => ['material' => $m2, 'jasa' => $j2],
                '1P FO to 3P FO' => ['material' => $m3, 'jasa' => $j3],
            ];

            foreach ($prices as $subpaketName => $value) {
                $material = $value['material'] === '-' ? 0 : str_replace(',', '', $value['material']);
                $jasa = $value['jasa'] === '-' ? 0 : str_replace(',', '', $value['jasa']);


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
