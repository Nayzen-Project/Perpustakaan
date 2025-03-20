<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class PetugasController extends Controller
{
    public function index()
    {
        $totalUlasan = Ulasan::count();
        $totalPeminjam = Peminjam::count();
        $totalPeminjaman = Peminjaman::count();
        $totalDenda = Denda::count();
        return view('petugas.dashboard', compact('totalUlasan','totalPeminjam','totalPeminjaman','totalDenda'));
    }

    public function profile()
    {
        return view('account.profile', ['user' => Auth::user()]);
    }

    // Method untuk menampilkan halaman pengaturan akun
    public function settings()
    {
        return view('account.settings', ['user' => Auth::user()]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
