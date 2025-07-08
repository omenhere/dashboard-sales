<?php

namespace App\Http\Controllers;

use App\Models\Witel;
use App\Models\Sto;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductPrice::with(['sto.witel', 'product.bundlings']);

        // Filter berdasarkan STO (jika ada)
        if ($request->sto) {
            $query->where('id_sto', $request->sto);
        }

        // Filter berdasarkan produk
        if ($request->product) {
            $query->where('id_product', $request->product);
        }

        // 🔥 Tambahkan ini untuk filter berdasarkan WITEL
        if ($request->witel) {
            $query->where('id_witel', $request->witel);
        }


        $pricings = $query->get();
        $stos = Sto::with('witel')->get();
        $witels = Witel::all();
        $products = Product::all();

        return view('pricing.index', compact('pricings', 'stos', 'witels', 'products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id_product',
            'id_witel' => 'required|exists:witels,id_witel',
            'harga_jasa' => 'required|numeric',

        ]);

        ProductPrice::create([
            'id_product' => $request->id_product,
            'id_witel' => $request->id_witel,
            'harga_jasa' => $request->harga_jasa
        ]);


        return redirect()->route('product-prices.index')->with('success', 'Harga berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pricing = ProductPrice::with(['product.bundlings', 'witel'])->findOrFail($id);

        $witels = Witel::all();
        $products = Product::with('bundlings')->get();

        return view('pricing.edit', compact('pricing', 'witels', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_product' => 'required',
            'id_witel' => 'required',
            'harga_jasa' => 'required|numeric',
            'harga_materi' => 'nullable|numeric',
        ]);

        $pricing = ProductPrice::findOrFail($id);
        $pricing->update([
            'id_product' => $request->id_product,
            'id_witel' => $request->id_witel,
            'harga_jasa' => $request->harga_jasa,
        ]);

        if (!is_null($request->harga_materi)) {
            $product = Product::find($request->id_product);
            $product->harga_materi = $request->harga_materi;
            $product->save();
        }

        return redirect()->route('product-prices.index')->with('success', 'Data berhasil diupdate.');
    }


    public function destroy(ProductPrice $product_price)
    {
        $product_price->delete();
        return redirect()->route('product-prices.index')->with('success', 'Data berhasil dihapus.');
    }

}
