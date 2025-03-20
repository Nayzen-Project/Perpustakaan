<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Cek apakah user belum dikonfirmasi
        if ($user->role === 'user' && !$user->is_confirmed) {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Akun Anda sedang dalam proses konfirmasi. Silakan tunggu persetujuan admin.');
        }

        // Jika user adalah peminjam, cek statusnya
        if ($user->role === 'user' && $user->peminjam && $user->peminjam->status !== 'active') {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Akun Anda telah dinonaktifkan. Silakan hubungi petugas.');
        }

        // Arahkan sesuai role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role === 'user') {
            return redirect()->intended(route('user.dashboard'));
        } elseif ($user->role === 'petugas') {
            return redirect()->intended(route('petugas.dashboard'));
        }

        return redirect()->route('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
