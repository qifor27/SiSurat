<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private array $jenisSurat = [
        'Undangan',
        'Pemberitahuan',
        'Permohonan',
        'Keputusan',
        'Instruksi',
        'Laporan',
        'Rekomendasi',
        'Lainnya',
    ];

    /**
     * Tampilkan daftar surat masuk milik admin yang sedang logi
     * Hanya menampilkan surat yang dibuat oleh user ini sendiri
     */
    public function index()
    {
        $suratMasuk = SuratMasuk::where('dibuat_oleh', auth()->id())
            ->latest('tanggal_diterima')
            ->paginate(10);

        return view('admin.surat-masuk.index', compact('suratMasuk'));
    }

    /**
     * Menampilkan form untuk membuat surat masuk baru
     * Mengirim array $jenisSurat ke view untuk dropdown
     */
    public function create()
    {
        return view('admin.surat-masuk.create', [
            'jenisSurat' => $this->jenisSurat,
        ]);
    }

    /**
     *  Simpan surat masuk baru ke database.
     * - Validasi dilakukan oleh StoreSuratMasukRequest (S1-02)
     * - Upload file dilakukan di sini (S1-03)
     * - Field dibuat_oleh dan status di-set otomatis
     */
    public function store(StoreSuratMasukRequest $request)
    {
        // Ambil data yang sudah lolos validasi
        $validated = $request->validated();
        // Upload file jika ada lampiran
        if ($request->hasFile('file_surat')) {
            $validated['file_path'] = $request->file('file_surat')
                ->store('surat-masuk', 'public');
        }
        // Set field otomatis (tidak boleh diisi user melalui form)
        $validated['dibuat_oleh'] = auth()->id();
        $validated['status'] = 'draft';

        // Auto-generate nomor agenda: SM-YYYYMMDD-XXX
        $today = now()->format('Ymd');
        $lastAgenda = SuratMasuk::where('nomor_agenda', 'like', "SM-{$today}-%")
            ->orderBy('nomor_agenda', 'desc')
            ->value('nomor_agenda');
        $nextNumber = $lastAgenda
            ? (int) substr($lastAgenda, -3) + 1
            : 1;
        $validated['nomor_agenda'] = "SM-{$today}-" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Simpan ke database
        SuratMasuk::create($validated);

        return redirect()
            ->route('admin.surat-masuk.index')
            ->with('success', 'Surat masuk berhasil disimpan.');
    }

    /**
     * Menampikan detail surat masuk
     */
    public function show(SuratMasuk $suratMasuk)
    {
        $suratMasuk->load('pembuat');

        return view('admin.surat-masuk.show',
            compact('suratMasuk'));
    }

    /**
     * Tampilkan form edit surat masuk
     * Hanya surat berstatus 'draft' yang boleh diedit
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        // Cegah edit jika surat sudah diajukan
        if (!in_array($suratMasuk->status,['draft','dikembalikan'])) {
            abort(403, 'Surat yang sudah diajukan tidak dapat diedit');
        }

        return view('admin.surat-masuk.edit', [
            'suratMasuk' => $suratMasuk,
            'jenisSurat' => $this->jenisSurat,
        ]);
    }

    /**
     * Update surat masuk yang sudah ada
     * Jka ada file baru, hapus file lama lalu simpan file baru
     * Hanua surat berstatus 'draft' yang boleh diupdate
     */
    public function update(UpdateSuratMasukRequest $request, SuratMasuk $suratMasuk)
    {
        // Cegah update jika sudah diajukan
        if (!in_array($suratMasuk->status,['draft','dikembalikan'])) {
            abort(403, 'Surat yang sudah diajukan tidak dapat diedit');
        }
        $validated = $request->validated();

        // Ganti file jika ada file baru di-upload
        if ($request->hasFile('file_surat')) {
            // Hapus file lama dari storage (jika ada)
            if ($suratMasuk->file_path) {
                Storage::disk('public')->delete($suratMasuk->file_path);
            }
            // Simpan file baru
            $validated['file_path'] = $request->file('file_surat')
                ->store('surat-masuk', 'public');
        }

        // Update record di database
        $suratMasuk->update($validated);

        return redirect()
            ->route('admin.surat-masuk.show', $suratMasuk)
            ->with('success', 'Surat masuk berhasil diperbarui');

    }

    /**
     * Ajukan surat ke Wakil Rektor (ubah status draft -> menunggu_warek).
     * Ini adalah transisi status pertama dalam alur disposisi
     */
    public function ajukan(SuratMasuk $suratMasuk)
    {
        // hanya surat draft yang boleh diajukan
        if (!in_array($suratMasuk->status,['draft','dikembalikan'])) {
            abort(403, 'Hanya surat berstatus draft yang dapat diajukan');
        }

        // Ubah status menjadi menunggu review wakil rektor
        $suratMasuk->update([
            'status' => 'menunggu_warek',
        ]);

        return redirect()
            ->route('admin.surat-masuk.show', $suratMasuk)
            ->with('success', 'Surat berhasil diajukan');
    }
}
