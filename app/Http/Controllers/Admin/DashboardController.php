<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik per status (hanya surat milik admin ini)
        $userId = auth()->id();

        $stats = [
            'total'           => SuratMasuk::where('dibuat_oleh', $userId)->count(),
            'draft'           => SuratMasuk::where('dibuat_oleh', $userId)->where('status', 'draft')->count(),
            'menunggu_warek'  => SuratMasuk::where('dibuat_oleh', $userId)->where('status', 'menunggu_warek')->count(),
            'menunggu_rektor' => SuratMasuk::where('dibuat_oleh', $userId)->where('status', 'menunggu_rektor')->count(),
            'selesai'         => SuratMasuk::where('dibuat_oleh', $userId)->where('status', 'selesai')->count(),
            'dikembalikan'    => SuratMasuk::where('dibuat_oleh', $userId)->where('status', 'dikembalikan')->count(),
            'hari_ini'        => SuratMasuk::where('dibuat_oleh', $userId)->whereDate('created_at', today())->count(),
        ];

        // 5 surat terbaru
        $suratTerbaru = SuratMasuk::where('dibuat_oleh', $userId)
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'suratTerbaru'));
    }
}
