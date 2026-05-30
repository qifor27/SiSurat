<?php

namespace App\Http\Controllers\WakilRektor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard wakil rektor.
     */
    public function index(Request $request)
    {
        return view('warek.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
