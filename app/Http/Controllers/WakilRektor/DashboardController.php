<?php

namespace App\Http\Controllers\WakilRektor;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jumlahMenunggu = SuratMasuk::where('status', 'menunggu_warek')->count();

        $suratTerbaru = SuratMasuk::where('status', 'menunggu_warek')
            ->latest('tanggal_diterima')
            ->take(5)
            ->get();

        return view('warek.dashboard', compact('jumlahMenunggu', 'suratTerbaru'));
    }
}
