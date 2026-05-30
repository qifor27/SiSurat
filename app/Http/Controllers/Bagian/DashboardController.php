<?php

namespace App\Http\Controllers\Bagian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard bagian terkait.
     */
    public function index(Request $request)
    {
        return view('bagian.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
