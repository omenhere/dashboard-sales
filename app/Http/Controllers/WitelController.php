<?php

namespace App\Http\Controllers;

use App\Models\Witel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WitelController extends Controller
{
    public function index()
    {
        $witels = Witel::all();
        return view('witels.index', compact('witels'));
    }

    public function create()
    {
        return view('witels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_witel' => 'required|string|max:255'
        ]);

        Witel::create($request->only('nama_witel'));

        return redirect()->route('witels.index')->with('success', 'Witel berhasil ditambahkan.');
    }

    public function show(Witel $witel)
    {
        return view('witels.show', compact('witel'));
    }

    public function edit(Witel $witel)
    {
        return view('witels.edit', compact('witel'));
    }

    public function update(Request $request, Witel $witel)
    {
        $request->validate([
            'nama_witel' => 'required|string|max:255'
        ]);

        $witel->update($request->only('nama_witel'));

        return redirect()->route('witels.index')->with('success', 'Witel berhasil diperbarui.');
    }

    public function destroy(Witel $witel)
    {
        $witel->delete();

        return redirect()->route('witels.index')->with('success', 'Witel berhasil dihapus.');
    }
}
