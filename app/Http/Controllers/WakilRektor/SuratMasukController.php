<?php

namespace App\Http\Controllers\WakilRektor;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

/**
 * Menampilkan daftar surat yang menunggu revisian
 * Menggunakan scope mengungguWarek() yang sudah ada di model
 */

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratMasuk::menungguWarek()
        ->latest('tanggal_diterima')
        ->paginate(10);

        return view('warek.surat-masuk.index',
        compact('suratMasuk'));
    }

    /**
 * Menampilka detal surat untuk di review ware
 */

public function show(SuratMasuk $suratMasuk)
{
    // Pastikan surat memang berstatus menunggu_warek
    if ($suratMasuk->status !== 'menunggu_warek') {
        abort(403, 'Surat ini tidak dalam antrian review anda');
    }

    $suratMasuk->load('pembuat');

    return view('warek.surat-masuk.show',
    compact('suratMasuk'));
}

/**
 * Ubah status dari menunggu_warek -> menunggu_rektor
 * Catatan warek bersifat opsioanl
 */
public function teruskan(Request $request, SuratMasuk $suratMasuk)
{
    if ($suratMasuk->status !== 'menunggu_warek') {
        abort(403, 'Surat ini tidak dalam antrian review anda');
    }
    $suratMasuk->update([
        'status' => 'menunggu_rektor',
        'catatan_warek' => $request->input('catatan_warek'),
    ]);

    return redirect()
        ->route('warek.surat-masuk.index')
        ->with('success', 'Surat berhasil diteruskan ke Rektor');

}

/**
 * S2-04 Kembalikan surat ke Admin
 * Catatan Wajib diisi agar admin tahu apa yyang perlu diperbaiki
 */

public function kembalikan(Request $request, SuratMasuk $suratMasuk)
{
    if ($suratMasuk->status !== 'menunggu_warek') {
        abort(403,'Surat ini tidak dalam antrian review anda');
    }

    // Validasi catata wajib diisi minimal 10 karakter
    $request->validasi([
        'catatan_warek' => 'required|string|min:10',

    ],[
        'catatan_warek.required' => 'Catatan wajib diisi saat mengembalikan surat',
        'catatan_warek.min' => 'Catatan minimal 10 karakter'
    ]);

    $suratMasuk->update([
        'status' => 'dikembalikan',
        'catatan_warek' => $request->input('catatan_warek'),
    ]);

    return redirect()
       ->route('warek.surat-masuk.index')
       ->with('success','Surat dikembalikan ke Admin dengan catatan');
}
}



