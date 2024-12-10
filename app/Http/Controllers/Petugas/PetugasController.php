<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index() {
        $title = 'Dashboard Petugas';
        return view('petugas.dashboard', compact('title'));
    }
}
