<?php

namespace App\Http\Controllers\Rektor;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jumlahMenunggu = SuratMasuk::where('status', 'menunggu_rektor')->count();

        $suratTerbaru = SuratMasuk::where('status', 'menunggu_rektor')
            ->latest('tanggal_diterima')
            ->take(5)
            ->get();

        return view('rektor.dashboard', compact('jumlahMenunggu', 'suratTerbaru'));
    }
}
