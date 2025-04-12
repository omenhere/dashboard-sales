<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pricing;
use App\Models\Witel;
use App\Models\Sto;
use App\Models\Subpaket;

class PricingController extends Controller
{
    public function index(Request $request)
    {
        $pricings = Pricing::query()
            ->with(['sto.witel', 'subpaket.bundle']);

        if ($request->filled('witel')) {
            $pricings->whereHas('sto.witel', function ($q) use ($request) {
                $q->where('id', $request->witel);
            });
        }

        if ($request->filled('sto')) {
            $pricings->where('sto_id', $request->sto);
        }

        if ($request->filled('bundle')) {
            $pricings->whereHas('subpaket.bundle', function ($q) use ($request) {
                $q->where('id', $request->bundle);
            });
        }

        if ($request->filled('subpaket')) {
            $pricings->where('subpaket_id', $request->subpaket);
        }

        return view('pricing.index', [
            'pricings' => $pricings->get(),
            'witels' => Witel::all(),
            'stos' => Sto::with('witel')->get(),
            //'bundles' => Bundle::all(),
            'subpakets' => Subpaket::with('bundle')->get(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'witel_id' => 'required|exists:witels,id',
            'sto_id' => 'required|exists:stos,id',
            'subpaket_id' => 'required|exists:subpakets,id',
            'material_price' => 'required|numeric',
            'jasa_price' => 'required|numeric',
        ]);

        Pricing::create([
            'id' => (string) Str::uuid(),
            'witel_id' => $request->witel_id,
            'sto_id' => $request->sto_id,
            'subpaket_id' => $request->subpaket_id,
            'material_price' => $request->material_price,
            'jasa_price' => $request->jasa_price,
        ]);

        return redirect()->back()->with('success', 'Pricing berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $pricing = Pricing::findOrFail($id);
        $pricing->delete();
        return redirect()->back()->with('success', 'Pricing berhasil dihapus.');
    }

    public function edit($id)
    {
        $pricing = Pricing::with(['sto.witel', 'subpaket.bundle'])->findOrFail($id);
        $witels = Witel::all();
        $stos = Sto::with('witel')->get();
        $subpakets = Subpaket::with('bundle')->get();

        return response()->json(compact('pricing', 'witels', 'stos', 'subpakets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'witel_id' => 'required|exists:witels,id',
            'sto_id' => 'required|exists:stos,id',
            'subpaket_id' => 'required|exists:subpakets,id',
            'material_price' => 'required|numeric',
            'jasa_price' => 'required|numeric',
        ]);

        $pricing = Pricing::findOrFail($id);
        $pricing->update([
            'witel_id' => $request->witel_id,
            'sto_id' => $request->sto_id,
            'subpaket_id' => $request->subpaket_id,
            'material_price' => $request->material_price,
            'jasa_price' => $request->jasa_price,
        ]);

        return response()->json(['message' => 'Data pricing berhasil diperbarui']);
    }

}
