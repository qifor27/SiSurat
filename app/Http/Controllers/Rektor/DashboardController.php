<?php

namespace App\Http\Controllers\Rektor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard rektor.
     */
    public function index(Request $request)
    {
        return view('rektor.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
