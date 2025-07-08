<?php

namespace App\Http\Controllers;

use App\Models\{Sale, Witel, Sto, Product};
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['sto.witel', 'product.bundlings']);

        if ($request->witel) {
            $query->where('id_witel', $request->witel);
        }
        if ($request->sto) {
            $query->where('id_sto', $request->sto);
        }
        if ($request->product) {
            $query->where('id_product', $request->product);
        }

        $sales = $query->get();


        $bundlingSummary = $sales
            ->groupBy(fn($s) => optional($s->product->bundlings->first())->name_bundling ?? '-')
            ->map(
                fn($bundle) =>
                $bundle->groupBy('product.name_product')->map(function ($group) {
                    $prod = $group->first()->product;
                    return (object) [
                        'id_product' => $prod->id_product ?? null,
                        'product' => $prod->name_product ?? '-',
                        'total' => $group->sum('quantity'),
                    ];
                })
            );

        $witels = Witel::all();
        $stos = Sto::with('witel')->get();
        $products = Product::all();

        return view('sales.index', compact(
            'sales',           
            'bundlingSummary',
            'witels',
            'stos',
            'products'
        ) + [                 
            'selectedWitel' => $request->witel,
            'selectedSto' => $request->sto,
            'selectedProd' => $request->product,
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_witel' => 'required|exists:witels,id_witel',
            'id_sto' => 'required|exists:stos,id_sto',
            'id_product' => 'required|exists:products,id_product',
            'quantity' => 'required|numeric|min:0',
        ]);

        Sale::create($validated);

        return redirect()->route('sales.index')
            ->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sale = Sale::with(['sto.witel', 'product.bundlings'])->findOrFail($id);
        $witels = Witel::all();
        $stos = Sto::with('witel')->get();
        $products = Product::all();

        return view('sales.edit', compact('sale', 'witels', 'stos', 'products'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_witel' => 'required|exists:witels,id_witel',
            'id_sto' => 'required|exists:stos,id_sto',
            'id_product' => 'required|exists:products,id_product',
            'quantity' => 'required|numeric|min:0',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update($validated);

        return redirect()->route('sales.index')
            ->with('success', 'Penjualan berhasil di-update.');
    }


    public function destroy(Sale $sale)
    {
        $sale->delete();
        return back()->with('success', 'Data penjualan berhasil dihapus.');
    }
}
