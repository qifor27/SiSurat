# PROMPT: Sprint 1 — CRUD Surat Masuk (S1-01 s/d S1-09)

> Simpan di: `e:\laravel\siSurat\.ai-docs\sprint\PROMPT_SPRINT1_CRUD_SURAT_MASUK.md`
> Gunakan di: **Claude Opus 4.6** (claude.ai — pilih model Opus 4.6)
> Kapan digunakan: Saat memulai Sprint 1 — CRUD Surat Masuk

---

## 🚨 ATURAN WAJIB — BACA INI SEBELUM APAPUN

> **Kamu TIDAK BOLEH menulis kode langsung ke file proyek.**
> **Kamu TIDAK BOLEH berasumsi kode sudah ada di file manapun.**
> **Semua kode WAJIB ditulis dalam format Implementation Plan.**

### Cara Kerja yang Benar

Saya adalah mahasiswa yang sedang belajar Laravel. Saya akan **membaca** implementation plan yang kamu buat, **memahami** setiap barisnya, lalu **mengetik ulang sendiri** ke file proyek. Ini bukan soal malas — ini cara saya belajar dan memastikan saya paham setiap baris kode di proyek saya.

Karena itu:
- **JANGAN** langsung tulis semua task sekaligus — kerjakan **SATU TASK PER SATU**
- **TUNGGU** konfirmasi saya ("sudah", "lanjut", "next") sebelum lanjut ke task berikutnya
- **TANYAKAN** jika ada yang ambigu sebelum menulis kode
- **JELASKAN** setiap bagian kode dalam Bahasa Indonesia yang mudah dipahami mahasiswa

### Format Setiap Implementation Plan

Setiap task harus mengikuti format ini persis:

```
═══════════════════════════════════════════════════
IMPLEMENTATION PLAN — [ID Task]: [Judul Task]
═══════════════════════════════════════════════════
Sprint      : Sprint 1 — CRUD Surat Masuk
Estimasi    : [X jam]
Dependency  : [daftar task yang sudah harus selesai]

─── DAFTAR FILE ────────────────────────────────────
| # | File         | Aksi         | Path Lengkap                      |
|---|--------------|--------------|-----------------------------------|
| 1 | NamaFile.php | NEW / MODIFY | app/Http/Controllers/NamaFile.php |

─── FILE 1: NamaFile.php [NEW] ─────────────────────
Path    : app/Http/Controllers/NamaFile.php
Command : php artisan make:controller NamaFile (jika ada)

[KODE LENGKAP — bukan snippet, dari baris pertama sampai terakhir file]

─── PENJELASAN FILE 1 ──────────────────────────────
• Baris X–Y  : [penjelasan Bahasa Indonesia — kenapa ditulis seperti ini]
• Baris X–Y  : [penjelasan Bahasa Indonesia]

─── CARA MENGETIK ──────────────────────────────────
1. [langkah konkret: buat folder, buat file, dll]
2. [langkah konkret]

─── COMMAND TERMINAL ───────────────────────────────
[perintah yang perlu dijalankan setelah file dibuat]

─── TEST WAJIB ─────────────────────────────────────
[ ] [URL yang dibuka + hasil yang diharapkan]
[ ] [checklist test manual]

─── SELESAI? ────────────────────────────────────────
Ketik "lanjut" atau "lanjut S1-XX" untuk lanjut ke task berikutnya.
```

---

## 🧠 IDENTITAS & KONTEKS PROYEK

```
Proyek     : SiSurat — Sistem Manajemen Surat Masuk Internal Kampus
Klien      : Universitas Alifah
Developer  : Mahasiswa (proyek perdana dengan klien nyata)
Framework  : Laravel 13.x | PHP 8.5 | MySQL 8.x
Auth       : Laravel Breeze (Blade + Tailwind CSS 4.x)
Roles      : Spatie Laravel Permission (admin, wakil_rektor, rektor, bagian_terkait)
OS         : Windows | Path: e:\laravel\siSurat\
Font       : Plus Jakarta Sans (body), JetBrains Mono (kode/nomor)
AI Model   : Claude Opus 4.6
```

---

## ✅ STATUS PRA-SPRINT (SUDAH SELESAI)

Semua task berikut sudah selesai dan berjalan sebelum Sprint 1 dimulai:

- **S0-01 s/d S0-04** — Instalasi Laravel, Breeze, Spatie Permission, konfigurasi database
- **S0-05** — Model `Bagian` dan `SuratMasuk` sudah ada dengan relasi dan cast
- **S0-06** — Seeder `BagianSeeder`, `RoleSeeder`, `UserSeeder` sudah berjalan
- **S0-07** — Route per role di `web.php`, redirect login dinamis berdasarkan role sudah jalan
- **S0-08** — Layout `app.blade.php` dan navigasi dengan `@role` directive sudah selesai

**Akun yang tersedia di database:**

| Role | Email | Password |
|------|-------|----------|
| admin | admin@alifah.ac.id | password |
| wakil_rektor | warek@alifah.ac.id | password |
| rektor | rektor@alifah.ac.id | password |
| bagian_terkait | bak@alifah.ac.id | password |

---

## 📐 SKEMA DATABASE YANG SUDAH ADA

### Tabel `surat_masuk` (sudah di-migrate)

```sql
id                BIGINT PK AUTO_INCREMENT
nomor_agenda      VARCHAR          -- auto-generate atau manual
nomor_surat       VARCHAR(100)     -- required
tanggal_surat     DATE             -- required
tanggal_diterima  DATE             -- required, default today
asal_surat        VARCHAR(255)     -- required
perihal           VARCHAR(500)     -- required
jenis_surat       VARCHAR          -- required
tingkat_urgensi   VARCHAR          -- normal | segera | sangat_segera
is_rahasia        BOOLEAN          -- default false
file_path         VARCHAR nullable -- path relatif dari storage/public
status            VARCHAR          -- draft|menunggu_warek|menunggu_rektor|selesai|dikembalikan
catatan_warek     TEXT nullable
catatan_rektor    TEXT nullable
dibuat_oleh       FK → users.id
created_at, updated_at
```

### Alur Status (dikonfirmasi klien)

```
draft → menunggu_warek → menunggu_rektor → selesai
                                         ↘ dikembalikan
```

> Sprint 1 hanya cover transisi: `draft → menunggu_warek`
> Transisi lainnya dikerjakan Sprint 2 dan 3.

---

## 🎨 DESIGN SYSTEM — WAJIB DIIKUTI UNTUK SEMUA VIEW

> Semua view Blade di Sprint 1 WAJIB mengikuti design system ini.
> Jangan gunakan warna atau radius di luar yang didefinisikan di sini.
> Design ini berdasarkan mockup resmi Universitas Alifah.

### Palet Warna Utama

```
/* Primary — Identitas Universitas Alifah */
Deep Blue    : #0F4C81   → sidebar, button primary, header
Soft Blue    : #2B6CB0   → link, badge aktif, accent
Light Blue   : #4A90E2   → hover, focus ring, highlight

/* Neutral */
Background   : #F5F7FA   → background seluruh halaman (bukan bg-gray-100)
Surface      : #FFFFFF   → card, panel, form
Border       : #E5E7EB   → border card, input, divider
Text Primary : #1F2937   → judul, body text utama
Text Second  : #6B7280   → label, placeholder, caption
Text Muted   : #9CA3AF   → teks tidak aktif
```

### Warna Badge Status Surat

```
draft            → bg-[#F3F4F6]  text-[#6B7280]   (abu)
menunggu_warek   → bg-[#FEF3C7]  text-[#D97706]   (kuning)
menunggu_rektor  → bg-[#DBEAFE]  text-[#2B6CB0]   (biru)
selesai          → bg-[#D1FAE5]  text-[#16A34A]   (hijau)
dikembalikan     → bg-[#FEE2E2]  text-[#DC2626]   (merah)
```

### Warna Badge Urgensi

```
normal         → bg-[#F3F4F6]  text-[#6B7280]
segera         → bg-[#FEF3C7]  text-[#D97706]
sangat_segera  → bg-[#FEE2E2]  text-[#DC2626]
```

### Spesifikasi Komponen

**Card:**
- Tailwind: `bg-white border border-gray-200 rounded-xl p-6 shadow-sm`
- border-radius WAJIB `rounded-xl` (12px) — bukan `rounded-lg` (8px) default Breeze

**Input Field:**
- Tailwind: `w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent`

**Label:**
- Tailwind: `block text-sm font-medium text-gray-700 mb-1.5`
- Required: tambahkan `<span class="text-red-500 ml-0.5">*</span>`

**Button Primary:**
- Tailwind: `bg-[#0F4C81] hover:bg-[#0A3A6B] text-white font-medium px-5 py-2.5 rounded-lg transition-colors`

**Button Secondary:**
- Tailwind: `border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-5 py-2.5 rounded-lg transition-colors`

**Badge (status/urgensi):**
- Tailwind base: `inline-flex items-center px-3 py-1 rounded-full text-xs font-medium`
- Tambahkan warna sesuai mapping di atas

**Section Header dalam card:**
```html
<div class="flex items-center gap-2 mb-4">
    <span class="text-lg">📄</span>
    <h3 class="text-base font-semibold text-gray-800">Nama Section</h3>
</div>
```

**Page Header (judul halaman + subtitle):**
```html
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Judul Halaman</h1>
        <p class="text-sm text-gray-500 mt-1">Deskripsi singkat halaman ini.</p>
    </div>
    <!-- action buttons di kanan jika ada -->
</div>
```

**Breadcrumb:**
```html
<nav class="text-sm text-gray-500 mb-4">
    <a href="[url]" class="hover:text-blue-600">Parent</a>
    <span class="mx-2">›</span>
    <span class="text-gray-800 font-medium">Halaman Ini</span>
</nav>
```

**Flash Message:**
```html
@if(session('success'))
    <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200
                text-green-700 text-sm px-4 py-3 rounded-lg">
        ✅ {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-200
                text-red-700 text-sm px-4 py-3 rounded-lg">
        ❌ {{ session('error') }}
    </div>
@endif
```

**Avatar Inisial:**
```html
<div class="w-8 h-8 rounded-full bg-blue-500 flex items-center
            justify-center text-white text-xs font-bold flex-shrink-0">
    {{ strtoupper(substr($user->name, 0, 2)) }}
</div>
```

---

## 📋 SPESIFIKASI VIEW PER HALAMAN

### index.blade.php — Daftar Surat Masuk

**Background halaman:** `min-h-screen bg-[#F5F7FA]`

**Page Header:**
- Kiri: judul "Daftar Surat Masuk" + subtitle "Kelola dan pantau semua surat yang masuk ke instansi."
- Kanan: tombol `+ Surat Baru` (button primary) → link ke `admin.surat-masuk.create`

**Filter Bar (di atas tabel):**
- Search input kiri: placeholder `"Cari nomor, pengirim, atau perihal..."` dengan icon search
- Tombol kanan: `"≡ Filter"` dan `"📅 Periode"` (outlined, non-fungsional Sprint 1)

**Tabel dalam card:**
- Kolom: `checkbox` | `NO` | `NOMOR SURAT` | `PERIHAL` | `ASAL SURAT` | `TGL DITERIMA` | `URGENSI` | `STATUS` | `AKSI`
- Header tabel: uppercase, text-xs, text-gray-500, border-b
- NO: nomor urut `01, 02...` bukan ID database (`$loop->iteration`)
- PERIHAL: maks 50 karakter + `...` (`Str::limit($surat->perihal, 50)`)
- TGL DITERIMA: format `07 Nov 2025` (`$surat->tanggal_diterima->format('d M Y')`)
- Row hover: `hover:bg-gray-50`
- Tidak ada border horizontal antar row, hanya `border-b border-gray-100`
- Aksi per row: `Lihat` (selalu) | `Edit` (hanya jika `status === 'draft'`)

**Pagination:**
```html
<div class="mt-4 flex items-center justify-between px-1 text-sm text-gray-500">
    <span>
        Menampilkan {{ $suratMasuk->firstItem() }}–{{ $suratMasuk->lastItem() }}
        dari {{ $suratMasuk->total() }} surat
    </span>
    {{ $suratMasuk->links() }}
</div>
```

---

### create.blade.php — Form Registrasi Surat Baru

**Breadcrumb:** `Surat Masuk › Registrasi Surat Baru`

**Page Header:**
- Kiri: "Registrasi Surat Masuk Baru" + subtitle
- Kanan: `Batal` (secondary) + `💾 Simpan Surat` (primary, type=submit)

**Layout 2 kolom:**
```html
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Card Informasi Dasar -->
        <!-- Card Catatan Tambahan -->
    </div>
    <div class="space-y-6">
        <!-- Card Lampiran Dokumen -->
        <!-- Card Metadata Sistem -->
    </div>
</div>
```

**Card Informasi Dasar:**
```
Section icon: 📄
Row 1 (2 col grid): Nomor Surat * | Tanggal Surat *
Row 2 (full):       Asal Surat *
                    placeholder: "Contoh: Kementerian Pendidikan dan Kebudayaan"
Row 3 (full):       Perihal * (textarea rows=3)
                    placeholder: "Tuliskan perihal atau ringkasan isi surat"
Row 4 (2 col grid): Jenis Surat * (select) | Tingkat Urgensi * (radio pills)
Row 5 (full):       Checkbox "Surat Rahasia" (is_rahasia)
```

**Jenis Surat — opsi dropdown:**
```php
$jenisSurat = ['Undangan', 'Pemberitahuan', 'Permohonan', 'Keputusan',
               'Instruksi', 'Laporan', 'Rekomendasi', 'Lainnya'];
```

**Tingkat Urgensi — styled radio pills:**
```html
<!-- Bukan radio button biasa, tapi styled pills yang bisa diklik -->
<div class="flex gap-2 flex-wrap">
    @foreach(['normal' => 'Biasa', 'segera' => 'Segera', 'sangat_segera' => 'Penting'] as $val => $label)
    <label class="cursor-pointer">
        <input type="radio" name="tingkat_urgensi" value="{{ $val }}"
               class="sr-only peer"
               {{ old('tingkat_urgensi', 'normal') === $val ? 'checked' : '' }}>
        <span class="px-3 py-1.5 rounded-full text-xs font-medium border
                     border-gray-200 text-gray-600 cursor-pointer
                     peer-checked:bg-[#0F4C81] peer-checked:text-white
                     peer-checked:border-[#0F4C81] transition-all">
            {{ $label }}
        </span>
    </label>
    @endforeach
</div>
```

**Card Lampiran Dokumen:**
```html
<div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center
            hover:border-blue-400 transition-colors" id="upload-area">
    <!-- SVG cloud upload icon -->
    <p class="text-sm font-medium text-gray-700 mt-3">Pilih File atau Drag & Drop</p>
    <p class="text-xs text-gray-400 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
    <label class="mt-3 inline-block border border-blue-500 text-blue-600
                  text-xs px-4 py-1.5 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
        Browse File
        <input type="file" name="file_surat" id="file-input" class="hidden"
               accept="application/pdf,image/jpeg,image/jpg,image/png">
    </label>
    <!-- Tampilkan nama file setelah dipilih -->
    <p id="file-name" class="text-xs text-gray-500 mt-2 hidden"></p>
</div>
<script>
    document.getElementById('file-input').addEventListener('change', function() {
        const name = this.files[0]?.name;
        const el = document.getElementById('file-name');
        if (name) { el.textContent = '📎 ' + name; el.classList.remove('hidden'); }
    });
</script>
```

**Card Metadata Sistem (read-only):**
```html
<div class="space-y-4 text-sm">
    <div>
        <p class="text-gray-500 text-xs uppercase font-medium mb-1">Tanggal Diterima</p>
        <p class="font-medium text-gray-800">{{ now()->format('d F Y, H:i') }} WIB</p>
    </div>
    <div>
        <p class="text-gray-500 text-xs uppercase font-medium mb-1">Dicatat oleh</p>
        <div class="flex items-center gap-2">
            [avatar inisial] <span class="font-medium">{{ auth()->user()->name }}</span>
        </div>
    </div>
    <div>
        <p class="text-gray-500 text-xs uppercase font-medium mb-1">No. Agenda</p>
        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded">
            AUTO-GENERATE
        </span>
    </div>
</div>
```

---

### show.blade.php — Detail Surat & Disposisi

**Breadcrumb:** `Surat Masuk › Detail Surat`

**Page Header:**
- Kiri: "Detail Surat & Disposisi" + subtitle "Kelola dan teruskan surat masuk ke unit terkait."
- Kanan: `🖨 Cetak Tanda Terima` (outlined, non-fungsional Sprint 1)

**Layout 2 kolom:**
```html
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
    <div class="lg:col-span-3 space-y-6">
        <!-- Card Informasi Surat -->
        <!-- Card Pratinjau Dokumen (jika ada file) -->
        <!-- Card Riwayat Perjalanan Surat -->
    </div>
    <div class="lg:col-span-2 space-y-6">
        <!-- Card Tindakan (jika draft) -->
        <!-- Card Catatan Warek (jika ada) -->
        <!-- Card Catatan Rektor (jika ada) -->
    </div>
</div>
```

**Card Informasi Surat:**
- Header card: `ℹ️ Informasi Surat` + badge status (kanan)
- Field rows dalam format: label uppercase text-xs text-gray-500 + nilai font-medium

```
NOMOR SURAT      | TANGGAL SURAT
ASAL INSTANSI    (full width)
PERIHAL          (full width, bisa multiline)
JENIS SURAT      | TINGKAT URGENSI (badge)
SIFAT            | DICATAT OLEH (avatar + nama)
TANGGAL DITERIMA | TANGGAL DIBUAT
```

**Card Pratinjau Dokumen:**
```html
@if($surat->file_path)
<div class="card">
    <div class="flex items-center justify-between mb-3">
        <div class="section-header">📎 Pratinjau Dokumen</div>
        <a href="{{ asset('storage/' . $surat->file_path) }}" download
           class="text-gray-400 hover:text-gray-600">
            <!-- download icon SVG -->
        </a>
    </div>
    <div class="bg-gray-50 rounded-lg p-8 text-center">
        <!-- icon file SVG -->
        <p class="text-sm text-gray-600 mt-2 font-medium">
            {{ basename($surat->file_path) }}
        </p>
        <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank"
           class="mt-3 inline-flex items-center gap-1 text-blue-600 text-sm hover:underline">
            Buka File →
        </a>
    </div>
</div>
@endif
```

**Card Riwayat Perjalanan Surat (timeline):**
```html
<div class="card">
    <div class="section-header mb-4">🕐 Riwayat Perjalanan Surat</div>
    <div class="space-y-0">

        {{-- Step 1: Draft dibuat --}}
        <div class="flex gap-3">
            <div class="flex flex-col items-center">
                <div class="w-3 h-3 rounded-full bg-[#0F4C81] mt-1 flex-shrink-0"></div>
                <div class="w-px flex-1 bg-gray-200 mt-1"></div>
            </div>
            <div class="pb-5">
                <p class="text-xs text-gray-400">{{ $surat->created_at->format('d M Y, H:i') }}</p>
                <p class="text-sm font-medium text-gray-800 mt-0.5">Surat Dibuat (Draft)</p>
                <p class="text-xs text-gray-500">Surat diinput oleh {{ $surat->pembuat->name }}</p>
            </div>
        </div>

        {{-- Step 2: Menunggu Warek --}}
        @php $steps = ['menunggu_warek','menunggu_rektor','selesai'];
             $passed = ['menunggu_warek','menunggu_rektor','selesai','dikembalikan']; @endphp
        <div class="flex gap-3">
            <div class="flex flex-col items-center">
                <div class="w-3 h-3 rounded-full mt-1 flex-shrink-0
                    {{ in_array($surat->status, ['menunggu_warek','menunggu_rektor','selesai','dikembalikan'])
                       ? 'bg-[#0F4C81]' : 'bg-gray-300' }}">
                </div>
                <div class="w-px flex-1 bg-gray-200 mt-1"></div>
            </div>
            <div class="pb-5">
                <p class="text-xs {{ in_array($surat->status, ['menunggu_warek']) ? 'text-blue-500 font-medium' : 'text-gray-400' }}">
                    {{ in_array($surat->status, ['menunggu_warek']) ? 'Saat ini' : '' }}
                </p>
                <p class="text-sm font-medium text-gray-800 mt-0.5">Review Wakil Rektor</p>
                <p class="text-xs text-gray-500">Menunggu peninjauan awal</p>
            </div>
        </div>

        {{-- Step 3: Menunggu Rektor --}}
        {{-- Step 4: Selesai --}}
        {{-- (pola sama seperti step 2) --}}

    </div>
</div>
```

**Card Tindakan (sidebar kanan):**
```html
@if($surat->status === 'draft' && $surat->dibuat_oleh === auth()->id())
<div class="card">
    <h3 class="font-semibold text-gray-800 mb-2">Tindakan</h3>
    <p class="text-sm text-gray-500 mb-4">
        Ajukan surat ini ke Wakil Rektor untuk memulai proses review.
    </p>
    <form method="POST" action="{{ route('admin.surat-masuk.ajukan', $surat) }}">
        @csrf
        @method('PATCH')
        <button type="submit"
                onclick="return confirm('Yakin ingin mengajukan surat ini ke Wakil Rektor?')"
                class="w-full bg-[#0F4C81] hover:bg-[#0A3A6B] text-white font-medium
                       px-5 py-2.5 rounded-lg transition-colors flex items-center
                       justify-center gap-2 text-sm">
            ▶ Ajukan ke Wakil Rektor
        </button>
    </form>
    <a href="{{ route('admin.surat-masuk.edit', $surat) }}"
       class="mt-2 w-full border border-gray-300 text-gray-700 hover:bg-gray-50
              font-medium px-5 py-2.5 rounded-lg transition-colors flex items-center
              justify-center gap-2 text-sm">
        ✏️ Edit Surat
    </a>
</div>
@endif

@if($surat->catatan_warek)
<div class="bg-white border border-gray-200 border-l-4 border-l-yellow-400 rounded-xl p-5">
    <h4 class="font-semibold text-gray-700 text-sm mb-2">💬 Catatan Wakil Rektor</h4>
    <p class="text-sm text-gray-600">{{ $surat->catatan_warek }}</p>
</div>


@endif

@if($surat->catatan_rektor)
<div class="bg-white border border-gray-200 border-l-4 border-l-blue-400 rounded-xl p-5">
    <h4 class="font-semibold text-gray-700 text-sm mb-2">💬 Catatan Rektor</h4>
    <p class="text-sm text-gray-600">{{ $surat->catatan_rektor }}</p>
</div>
@endif
```

---

## 📋 SPESIFIKASI TEKNIS SETIAP TASK

### S1-09 — Route (Kerjakan PERTAMA)

Tambahkan di dalam group `role:admin` di `web.php`:

```php
Route::resource('surat-masuk', Admin\SuratMasukController::class)
     ->except(['destroy']);
Route::patch('surat-masuk/{suratMasuk}/ajukan',
     [Admin\SuratMasukController::class, 'ajukan'])
     ->name('surat-masuk.ajukan');
```

---

### S1-01 — SuratMasukController

**Path:** `app/Http/Controllers/Admin/SuratMasukController.php`

```
index()   → where('dibuat_oleh', auth()->id())->latest('tanggal_diterima')->paginate(10)
create()  → return view + $jenisSurat array untuk dropdown
store()   → StoreSuratMasukRequest + upload file + merge dibuat_oleh + status=draft
show()    → with('pembuat') eager load
edit()    → abort(403) jika status !== 'draft'
update()  → UpdateSuratMasukRequest + hapus file lama jika ada file baru
ajukan()  → abort(403) jika status !== 'draft', update + flash + redirect show
```

---

### S1-02 — Form Request

`StoreSuratMasukRequest`:
```php
'nomor_surat'      => 'required|string|max:100',
'tanggal_surat'    => 'required|date',
'tanggal_diterima' => 'required|date',
'asal_surat'       => 'required|string|max:255',
'perihal'          => 'required|string|max:500',
'jenis_surat'      => 'required|string',
'tingkat_urgensi'  => 'required|in:normal,segera,sangat_segera',
'is_rahasia'       => 'nullable|boolean',
'file_surat'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
```

`UpdateSuratMasukRequest` — sama, tapi `nomor_surat` pakai `sometimes|required`.

---

### S1-03 — Upload File

```php
// store()
if ($request->hasFile('file_surat')) {
    $filePath = $request->file('file_surat')->store('surat-masuk', 'public');
}

// update() — ganti file lama jika ada
if ($request->hasFile('file_surat')) {
    if ($surat->file_path) {
        Storage::disk('public')->delete($surat->file_path);
    }
    $filePath = $request->file('file_surat')->store('surat-masuk', 'public');
}

// Akses URL file di view
asset('storage/' . $surat->file_path)
```

---

## 📁 DAFTAR LENGKAP FILE

| # | File | Aksi |
|---|------|------|
| 1 | `routes/web.php` | MODIFY |
| 2 | `app/Http/Controllers/Admin/SuratMasukController.php` | NEW |
| 3 | `app/Http/Requests/StoreSuratMasukRequest.php` | NEW |
| 4 | `app/Http/Requests/UpdateSuratMasukRequest.php` | NEW |
| 5 | `resources/views/admin/surat-masuk/index.blade.php` | NEW |
| 6 | `resources/views/admin/surat-masuk/create.blade.php` | NEW |
| 7 | `resources/views/admin/surat-masuk/edit.blade.php` | NEW |
| 8 | `resources/views/admin/surat-masuk/show.blade.php` | NEW |

---

## ⛔ CONSTRAINT YANG TIDAK BOLEH DILANGGAR

1. **JANGAN** gunakan `Route::delete` — surat tidak dihapus (standar kearsipan)
2. **JANGAN** hardcode `dibuat_oleh` — selalu dari `auth()->id()`
3. **JANGAN** tampilkan tombol Edit/Ajukan jika status bukan `draft`
4. **JANGAN** buat halaman register — sistem internal
5. **JANGAN** gunakan raw SQL — selalu Eloquent
6. **JANGAN** gunakan `$guarded = []` — selalu `$fillable`
7. **JANGAN** install package baru
8. **JANGAN** gunakan warna di luar design system yang sudah didefinisikan di atas
9. **JANGAN** gunakan `bg-gray-100` untuk background halaman — harus `bg-[#F5F7FA]`
10. **WAJIB** `@csrf` di semua form
11. **WAJIB** `enctype="multipart/form-data"` di form yang ada upload file
12. **WAJIB** validasi file: `mimes:pdf,jpg,jpeg,png|max:5120`
13. **WAJIB** `asset('storage/' . $surat->file_path)` untuk URL file
14. **WAJIB** jalankan `php artisan storage:link` sebelum test upload
15. **WAJIB** card border-radius `rounded-xl` (12px) — bukan `rounded-lg`
16. **WAJIB** tampilkan error validasi `@error` di bawah setiap input field
17. **WAJIB** gunakan `old('field')` untuk repopulate form setelah error validasi

---

## ⌨️ SHORTCUT COMMAND

| Command | Respons yang diharapkan |
|---------|------------------------|
| `mulai S1-09` | Buat implementation plan S1-09 saja, lalu tunggu |
| `lanjut` | Kerjakan task berikutnya sesuai urutan |
| `lanjut S1-03` | Kerjakan S1-03 spesifik |
| `jelaskan S1-04` | Jelaskan S1-04 tanpa menulis kode |
| `review S1-01` | Review kode yang sudah saya ketik, cari bug |
| `error: [pesan]` | Bantu debug error yang saya alami |
| `status` | Tampilkan progress Sprint 1 — mana yang sudah/belum |
| `ulangi` | Tampilkan ulang plan task yang barusan |

**Urutan pengerjaan Sprint 1:**
```
S1-09 → S1-01 → S1-02 → S1-03
              → S1-04
              → S1-05 → S1-06 → S1-07 → S1-08
```

---

## 📌 CATATAN UNTUK CLAUDE OPUS 4.6

### Tentang Workflow
- **SATU TASK PER RESPONS** — jangan selesaikan semua 9 task sekaligus
- **TUNGGU KONFIRMASI** setelah setiap task sebelum lanjut
- Jika ada error yang saya kirim, **debug dulu** sebelum lanjut task berikutnya
- Jika ada yang ambigu, **tanya dulu** sebelum menulis kode

### Tentang Kualitas Kode
- Proyek ini untuk **klien nyata (Universitas Alifah)** — kode harus production-ready
- **Bahasa Indonesia** untuk komentar kode dan semua penjelasan
- **Bahasa Inggris** untuk nama variabel, method, class, fungsi
- Pilih cara **eksplisit dan mudah dibaca** daripada cara pintas yang membingungkan
- Setiap konsep baru beri **analogi sederhana** untuk mahasiswa yang baru belajar Laravel

### Tentang Desain
- Semua view WAJIB menggunakan design system di bagian `🎨 DESIGN SYSTEM`
- Background halaman: `bg-[#F5F7FA]` — bukan default Breeze
- Card: `rounded-xl` + `shadow-sm` — bukan default Breeze
- Button primary: `bg-[#0F4C81]` — Deep Blue Universitas Alifah
- Warna badge status harus sesuai mapping yang sudah didefinisikan

### Tentang Standar
- Ikuti standar sistem informasi kampus Indonesia (SIMAK UI, Siakad, dll)
- Kode harus bisa dijelaskan ke dosen pembimbing
- Keamanan tidak boleh dikompromikan: `@csrf`, Form Request, middleware role