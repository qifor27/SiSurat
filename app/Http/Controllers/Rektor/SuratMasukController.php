<?php

namespace App\Http\Controllers\Rektor;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\Bagian;
use App\Models\Disposisi;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    /**
     * Tampilkan daftar surat yang menunggu persetujuan Rektor
     */

    public function index()
    {
        $suratMasuk = SuratMasuk::menungguRektor()
          ->latest('tanggal_diterima')
          ->paginate(10);

        return view('rektor.surat-masuk.index', compact('suratMasuk'));
    }

    /**
     * Tampilkan detail surat untuk di-review rektor
     * Memuat juga catatan warek dan daftar bagian (untuk disposisi)
     */

    public function show(SuratMasuk $suratMasuk)
    {
        // Rektor boleh liat surat menunggu_rektor dan selesai
        if (!in_array($suratMasuk->status,['menunggu_rektor','selesai'])) {
            abort(403,'Surat ini tidak dalam antrian review anda.');
        }
        $suratMasuk->load(['pembuat','disposisis.bagians']);

        //Ambil daftar baian untuk form disposisi
        $bagians = Bagian::orderBy('nama_bagian')->get();

        return view('rektor.surat-masuk.show',compact('suratMasuk','bagians'));
    }

    /**
     * Catatan Rektor bersifat opsional
     */

    public function approve(Request $request, SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->status !== 'menunggu_rektor') {
            abort(403, 'surat ini ini tidk dalam antrian review anda');
        }

        $suratMasuk->update([
            'status'=> 'selesai',
            'catatan_rektor' => $request->input('catatan_rektor'),
        ]);
        return redirect()
            ->route('rektor.surat-masuk.index')
            ->with('success','surat telah disetujui');
    }

    /**
     * S3-03: Kembalikan surat ke Admin.
     * Catatan WAJIB diisi.
     */

    public function kembalikan(Request $request, SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->status !== 'menunggu_rektor') {
            abort(403, 'Surat ini tidak dalam antrian review Anda.');
        }

        $request->validate([
            'catatan_rektor' => 'required|string|min:10',
        ], [
            'catatan_rektor.required' => 'Catatan wajib diisi saat mengembalikan surat.',
            'catatan_rektor.min' => 'Catatan minimal 10 karakter.',
        ]);

        $suratMasuk->update([
            'status' => 'dikembalikan',
            'catatan_rektor' => $request->input('catatan_rektor'),
        ]);

        return redirect()
            ->route('rektor.surat-masuk.index')
            ->with('success', 'Surat dikembalikan ke Admin.');
    }

/**
 * S3-05 buat disposisi ke bagian terkait
 */

public function storeDisposisi(Request $request,SuratMasuk $suratMasuk)
{
    if ($suratMasuk->status !== 'selesai') {
        abort(403,'Disposisi hanya bisa dibuat untuk surat yang sudah disetujui');
    }

    $request->validate([
        'instruksi' => 'required|string|min:10',
        'bagian_ids' => 'required|array|min:1',
        'bagian_ids.*' => 'exists:bagian,id',
        'catatan' => 'nullable|string',

    ],[

        'instruksi.required' => 'Instruksi disposisi wajib diisi.',
        'instruksi.min' => 'Instruksi minimal 10 karakter.',
        'bagian_ids.required' => 'Pilih minimal satu bagian terkait.',
    ]);

    $disposisi = Disposisi::create([
        'surat_masuk_id' => $suratMasuk->id,
        'dibuat_oleh' => auth()->id(),
        'instruksi' => $request->input('instruksi'),
        'catatan' => $request->input('catatan'),
    ]);

    // Attach bagian-bagian yang dipilih ke tabel pivot
    $disposisi->bagians()->attach($request->input('bagian_ids'));

    return redirect()
          ->route('rektor.surat-masuk.show',$suratMasuk)
          ->with('success','Disposisi berhasl dibuat');
}


}
