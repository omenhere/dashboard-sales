<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Sale;
use App\Models\Pricing;
use App\Models\Sto;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function showProfit(Request $request)
    {
        $selectedSto = $request->query('sto');
        $stos = Sto::orderBy('name')->get();

        $bundles = Bundle::with('subpakets')->get();
        $result = [];

        $materialGrandTotal = 0;
        $jasaGrandTotal = 0;
        $jasaKpiGrandTotal = 0;

        foreach ($bundles as $bundle) {
            foreach ($bundle->subpakets as $subpaket) {
                $sales = Sale::query()
                    ->where('subpaket_id', $subpaket->id)
                    ->when($selectedSto, fn($q) => $q->whereHas('sto', fn($s) => $s->where('name', $selectedSto)))
                    ->with('sto')
                    ->get();

                $materialTotal = 0;
                $jasaTotal = 0;
                $jasaAfterKpiTotal = 0;

                foreach ($sales as $sale) {
                    if ($sale->quantity <= 0) continue;

                    $pricing = Pricing::where('sto_id', $sale->sto_id)
                        ->where('subpaket_id', $sale->subpaket_id)
                        ->first();

                    if (!$pricing) continue;

                    $material = $pricing->material_price ?? 0;
                    $jasa = $pricing->jasa_price ?? 0;
                    $kpi = $sale->sto->kpi ?? 100;
                    $effectiveKpi = $kpi >= 100 ? 1 : $kpi / 100;

                    $materialTotal += $sale->quantity * $material;
                    $jasaTotal += $sale->quantity * $jasa;
                    $jasaAfterKpiTotal += $sale->quantity * ($jasa * $effectiveKpi);
                }

                $totalProfit = $materialTotal + $jasaAfterKpiTotal;

                $result[$bundle->name][] = (object) [
                    'subpaket' => $subpaket->name,
                    'material' => $materialTotal,
                    'jasa' => $jasaTotal,
                    'jasa_after_kpi' => $jasaAfterKpiTotal,
                    'profit' => $totalProfit,
                ];

                $materialGrandTotal += $materialTotal;
                $jasaGrandTotal += $jasaTotal;
                $jasaKpiGrandTotal += $jasaAfterKpiTotal;
            }
        }

        $selectedKpi = null;
        if ($selectedSto) {
            $stoModel = $stos->firstWhere('name', $selectedSto);
            $selectedKpi = $stoModel?->kpi;
        }

        return view('profit.index', compact(
            'result',
            'stos',
            'selectedSto',
            'materialGrandTotal',
            'jasaGrandTotal',
            'jasaKpiGrandTotal',
            'selectedKpi'
        ));
    }
}
