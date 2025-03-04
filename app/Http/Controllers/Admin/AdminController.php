<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\KategoriBuku;
use App\Models\KoleksiBuku;
use App\Models\ListKategori;
use App\Models\ListPeminjaman;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalpeminjamen = Peminjaman::count();
        $totaldendas = Denda::count();
        $totalpetugas = Petugas::count();
        $totalpeminjams = Peminjam::count();
        $totalusers = User::count();
        $users = User::all();
        return view('admin.dashboard',compact('totalusers','totalpeminjams','totalpetugas','totaldendas','totalpeminjamen','users'))->with('title','Dashboard');
    }

    // // Create User
    // public function store(Request $request)
    // {
    //     // Validasi input data
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8',
    //         'role' => 'required|string|in:admin,user,petugas',
    //     ]);

    //     // Membuat user baru
    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //         'role' => $validated['role'],
    //     ]);

    //     // Redirect setelah user berhasil dibuat
    //     return redirect()->route('admin.dashboard')->with('success', 'User created successfully');
    // }

    // public function destroy(User $user)
    // {
    //     $user->delete();

    //     return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    // }
}
