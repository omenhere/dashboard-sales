<?php

namespace App\Http\Controllers;
use App\Models\Bundling;
use Illuminate\Http\Request;


class BundlingController extends Controller
{
    public function index()
    {
        $bundlings = Bundling::all();
        return view('bundlings.index', compact('bundlings'));
    }

    public function create()
    {
        return view('bundlings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_bundling' => 'required|string|max:255'
        ]);

        Bundling::create($request->only('name_bundling'));

        return redirect()->route('bundlings.index')->with('success', 'Bundling berhasil ditambahkan.');
    }

    public function show(Bundling $bundling)
    {
        return view('bundlings.show', compact('bundling'));
    }

    public function edit(Bundling $bundling)
    {
        return view('bundlings.edit', compact('bundling'));
    }

    public function update(Request $request, Bundling $bundling)
    {
        $request->validate([
            'name_bundling' => 'required|string|max:255'
        ]);

        $bundling->update($request->only('name_bundling'));

        return redirect()->route('bundlings.index')->with('success', 'Bundling berhasil diperbarui.');
    }

    public function destroy(Bundling $bundling)
    {
        $bundling->delete();
        return redirect()->route('bundlings.index')->with('success', 'Bundling berhasil dihapus.');
    }
}
