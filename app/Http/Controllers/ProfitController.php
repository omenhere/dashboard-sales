<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\STO;
use App\Models\Witel;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\Log;

class ProfitController extends Controller
{
    public function index(Request $request)
    {
        $selectedSto = $request->input('sto');
        $selectedWitel = $request->input('witel');

        $salesQuery = Sale::with(['product.bundlings', 'sto.witel']);


        if ($request->witel) {
            $salesQuery->where('id_witel', $request->witel);
        }
        if ($request->sto) {
            $salesQuery->where('id_sto', $request->sto);
        }

        $sales = $salesQuery->get();

        $totalMaterialValue = 0;
        $totalJasaValue = 0;
        $totalpenjualan = 0;

        foreach ($sales as $sale) {
            $qty = $sale->quantity ?? 0;

            $totalpenjualan += $qty;
            $hargaMateri = $sale->product->harga_materi ?? 0;

            $hargaJasa = ProductPrice::where('id_product', $sale->id_product)
                ->where('id_witel', $sale->id_witel)
                ->value('harga_jasa');


            if ($qty > 0) {
                $totalMaterialValue += $hargaMateri * $qty;
                $totalJasaValue += $hargaJasa * $qty;
            }

        }

        $totalValue = $totalMaterialValue + $totalJasaValue;


        $rekapPerSto = $sales->groupBy('id_sto')->map(function ($salesInSto) {
            $sto = optional($salesInSto->first()->sto);
            $witel = optional($sto->witel);
            $kpi = $sto->kpi ?? 100;
            $kpiDecimal = $kpi / 100;

            $totalMaterial = $salesInSto->sum(function ($sale) {
                return ($sale->product->harga_materi ?? 0) * ($sale->quantity ?? 0);
            });

            $totalJasa = $salesInSto->sum(function ($sale) {
                $hargaJasa = optional(
                    $sale->product->prices->firstWhere('id_witel', $sale->id_witel)
                )->harga_jasa ?? 0;


                return $hargaJasa * ($sale->quantity ?? 0);
            });

            $baijJasa = $totalJasa * ($kpiDecimal >= 1 ? 1 : $kpiDecimal);
            $pembulatanBaij = round($baijJasa, -3);
            $total = $totalMaterial + $baijJasa;
            $totalBulat = $totalMaterial + $pembulatanBaij;

            return (object) [
                'sto' => $sto->nama_sto ?? '-',
                'witel' => $witel->nama_witel ?? '-',
                'material' => $totalMaterial,
                'jasa' => $totalJasa,
                'kpi' => $kpi,
                'baij_jasa' => $baijJasa,
                'pembulatan_baij' => $pembulatanBaij,
                'total' => $total,
                'total_bulat' => $totalBulat,
            ];
        })->values();



        return view('profit.index', [
            'stos' => STO::all(),
            'witels' => Witel::all(),
            'selectedSto' => $selectedSto,
            'selectedWitel' => $selectedWitel,
            'totalMaterialValue' => $totalMaterialValue,
            'totalJasaValue' => $totalJasaValue,
            'totalValue' => $totalValue,
            'totalpenjualan' => $totalpenjualan,
            'rekapPerSto' => $rekapPerSto,
        ]);
    }
}
