<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sto;
use Illuminate\Support\Str;

class StoController extends Controller
{
    /**
     * Menampilkan daftar STO.
     */
    public function index()
    {
        $stos = Sto::with('witel')->get();
        return response()->json($stos);
    }

    /**
     * Menyimpan STO baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'witel_id' => 'required|exists:witels,id',
            'name' => 'required|string|max:50|unique:stos,name',
        ]);

        $sto = Sto::create([
            'id' => Str::uuid(),
            'witel_id' => $request->witel_id,
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'STO berhasil ditambahkan', 'data' => $sto], 201);
    }

    /**
     * Menampilkan detail satu STO berdasarkan ID.
     */
    public function show($id)
    {
        $sto = Sto::with('witel')->find($id);
        
        if (!$sto) {
            return response()->json(['message' => 'STO tidak ditemukan'], 404);
        }

        return response()->json($sto);
    }

    /**
     * Mengupdate data STO.
     */
    public function update(Request $request, $id)
    {
        $sto = Sto::find($id);

        if (!$sto) {
            return response()->json(['message' => 'STO tidak ditemukan'], 404);
        }

        $request->validate([
            'witel_id' => 'required|exists:witels,id',
            'name' => 'required|string|max:50|unique:stos,name,' . $id,
        ]);

        $sto->update([
            'witel_id' => $request->witel_id,
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'STO berhasil diperbarui', 'data' => $sto]);
    }

    /**
     * Menghapus STO.
     */
    public function destroy($id)
    {
        $sto = Sto::find($id);

        if (!$sto) {
            return response()->json(['message' => 'STO tidak ditemukan'], 404);
        }

        $sto->delete();

        return response()->json(['message' => 'STO berhasil dihapus']);
    }
}
