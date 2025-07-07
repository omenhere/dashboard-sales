<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Bundling;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('bundlings')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $bundlings = Bundling::all();
        return view('products.create', compact('bundlings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'bundling_ids' => 'array|exists:bundlings,id'
        ]);

        $product = Product::create($request->only('name_product'));
        $product->bundlings()->sync($request->bundling_ids);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('bundlings');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $bundlings = Bundling::all();
        $product->load('bundlings');
        return view('products.edit', compact('product', 'bundlings'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'bundling_ids' => 'array|exists:bundlings,id'
        ]);

        $product->update($request->only('name_product'));
        $product->bundlings()->sync($request->bundling_ids);

        return redirect()->route('products.index')->with('success', 'Product berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->bundlings()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus.');
    }
}
