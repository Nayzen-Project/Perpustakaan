<?php

namespace App\Http\Controllers\Petugas\Ulasan;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasans = Ulasan::all();
        return view('petugas.layouts.pages.ulasan.data-ulasan', compact('ulasans'))->with('title','Ulasan');
    }

    public function update(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'ulasan' => 'required|string',
        ]);

        // Update ulasan
        $ulasan->ulasan = $request->ulasan;
        $ulasan->save();

        return redirect()->route('petugas.ulasan')->with('success', 'Ulasan berhasil diperbarui!');
    }

    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();

        return redirect()->route('petugas.ulasan')->with('success', 'Ulasan berhasil dihapus!');
    }
}
