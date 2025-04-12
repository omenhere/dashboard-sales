<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Witel;
use App\Models\Sto;
use App\Models\Subpaket;
use App\Models\Bundle;

class SaleController extends Controller
{
    public function recapWithFilter(Request $request)
    {
        $selectedWitel = $request->query('witel');
        $selectedSto = $request->query('sto');

        $allWitels = Witel::with('stos')->orderBy('name')->get();
        $allBundles = Bundle::with('subpakets')->get();

        if ($selectedSto && !$selectedWitel) {
            $stoModel = Sto::with('witel')->where('name', $selectedSto)->first();
            $selectedWitel = $stoModel?->witel?->name;
        }

        $result = [];

        foreach ($allBundles as $bundle) {
            foreach ($bundle->subpakets as $subpaket) {
                $query = Sale::whereHas('witel', fn($q) => $q->where('name', $selectedWitel));

                if ($selectedSto) {
                    $query->whereHas('sto', fn($q) => $q->where('name', $selectedSto));
                }

                $total = $query->where('subpaket_id', $subpaket->id)->sum('quantity');

                $result[$bundle->name][] = (object) [
                    'subpaket' => $subpaket->name,
                    'total' => $total,
                ];
            }
        }

        $stos = collect();
        if ($selectedWitel) {
            $wit = $allWitels->firstWhere('name', $selectedWitel);
            $stos = $wit ? $wit->stos : collect();
        }

        return view('sales.index', [
            'result' => $result,
            'witels' => $allWitels,
            'stos' => $stos,
            'selectedWitel' => $selectedWitel,
            'selectedSto' => $selectedSto,
        ]);
    }

    public function index()
    {
        $sales = Sale::with(['witel', 'sto', 'subpaket'])->latest()->paginate(20);
        $witels = Witel::all();
        $stos = Sto::all();
        $subpakets = Subpaket::with('bundle')->get();

        return view('sales.index', compact('sales', 'witels', 'stos', 'subpakets'));
    }

    public function create()
    {
        $witels = Witel::all();
        $stos = Sto::all();
        $subpakets = Subpaket::all();
        return view('sales.create', compact('witels', 'stos', 'subpakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'witel_id' => 'required|exists:witels,id',
            'sto_id' => 'required|exists:stos,id',
            'subpaket_id' => 'required|exists:subpakets,id',
            'quantity' => 'required|integer|min:0',
            'sale_date' => 'required|date',
        ]);

        Sale::create([
            'id' => \Str::uuid(),
            'witel_id' => $request->witel_id,
            'sto_id' => $request->sto_id,
            'subpaket_id' => $request->subpaket_id,
            'quantity' => $request->quantity,
            'sale_date' => $request->sale_date,
        ]);

        return redirect()->route('sales.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sale = Sale::with(['witel', 'sto', 'subpaket'])->findOrFail($id);
        $witels = Witel::all();
        $stos = Sto::all();
        $subpakets = Subpaket::all();

        return response()->json(compact('sale', 'witels', 'stos', 'subpakets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'witel_id' => 'required|exists:witels,id',
            'sto_id' => 'required|exists:stos,id',
            'subpaket_id' => 'required|exists:subpakets,id',
            'quantity' => 'required|integer|min:0',
            'sale_date' => 'required|date',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update($request->only(['witel_id', 'sto_id', 'subpaket_id', 'quantity', 'sale_date']));

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->back()->with('success', 'Data penjualan berhasil dihapus.');
    }
}
