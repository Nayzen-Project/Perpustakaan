<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.layouts.pages.user.data-user', compact('users'))->with('title', 'User');
    }

    public function confirmUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_confirmed = true;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil dikonfirmasi.');
    }
}
