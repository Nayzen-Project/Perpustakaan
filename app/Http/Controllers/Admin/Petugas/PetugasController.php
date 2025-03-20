<?php

namespace App\Http\Controllers\Admin\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::with('user')->get();
        return view('admin.layouts.pages.petugas.data-petugas', compact('petugas'))->with('title', 'PETUGAS');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:petugas,admin', // Validasi role
            'nama_lengkap' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Buat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role sesuai pilihan
        ]);

        // Buat Petugas/Admin dengan role yang dipilih
        Petugas::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role, // Role harus sesuai dengan user
            'nama_lengkap' => $request->nama_lengkap,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Petugas/Admin berhasil ditambahkan');
    }

    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petugas->user_id,
            'role' => 'required|in:petugas,admin',
            'nama_lengkap' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $user = User::findOrFail($petugas->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $petugas->update([
            'email' => $user->email,
            'role' => $user->role,
            'nama_lengkap' => $request->nama_lengkap,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Data Petugas/Admin berhasil diperbarui');
    }

    public function destroy(Petugas $petugas)
    {
        $petugas->delete();

        return redirect()->route('admin.petugas')->with('success', 'petugas/Admin deleted successfully');
    }

}

