<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $title = 'Dashboard User';
        return view('user.dashboard', compact('title'));
    }
}