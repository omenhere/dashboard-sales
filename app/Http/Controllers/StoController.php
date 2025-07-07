<?php

namespace App\Http\Controllers;

use App\Models\Sto;
use App\Models\Witel;
use Illuminate\Http\Request;

class StoController extends Controller
{
    public function index()
    {
        $stos = Sto::with('witel')->get();
        return view('stos.index', compact('stos'));
    }

    public function create()
    {
        $witels = Witel::all();
        return view('stos.create', compact('witels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sto' => 'required|string|max:255',
            'id_witel' => 'required|exists:witels,id'
        ]);

        Sto::create($request->only('nama_sto', 'id_witel'));

        return redirect()->route('stos.index')->with('success', 'STO berhasil ditambahkan.');
    }

    public function show(Sto $sto)
    {
        return view('stos.show', compact('sto'));
    }

    public function edit(Sto $sto)
    {
        $witels = Witel::all();
        return view('stos.edit', compact('sto', 'witels'));
    }

    public function update(Request $request, Sto $sto)
    {
        $request->validate([
            'nama_sto' => 'required|string|max:255',
            'id_witel' => 'required|exists:witels,id'
        ]);

        $sto->update($request->only('nama_sto', 'id_witel'));

        return redirect()->route('stos.index')->with('success', 'STO berhasil diperbarui.');
    }

    public function destroy(Sto $sto)
    {
        $sto->delete();
        return redirect()->route('stos.index')->with('success', 'STO berhasil dihapus.');
    }
}