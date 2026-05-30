# UI Specifications — SiSurat (dari Mockup)

> [!NOTE]
> Dokumen ini diekstrak dari 5 mockup design yang dibuat di Google Stitch.
> Semua halaman harus mengikuti spesifikasi ini secara konsisten.

---

## 1. Halaman Login

### Layout
- **Split screen**: Kiri (form login ~50%), Kanan (branding panel ~50%)
- Responsive: Pada mobile, panel kanan disembunyikan

### Panel Kiri (Form)
- **Logo**: Icon "A" rounded navy + teks "SiSurat"
- **Heading**: "Selamat Datang Kembali" (bold, large)
- **Subheading**: "Masukkan email dan kata sandi Anda untuk mengakses akun."
- **Form fields**:
  - Email — placeholder: `nama@alifah.ac.id`
  - Kata Sandi — dengan toggle visibility (eye icon)
- **Options**: Checkbox "Ingat Saya" | Link "Lupa Kata Sandi?"
- **Button**: "Masuk" — full-width, navy background, white text, rounded
- **Divider**: "ATAU MASUK DENGAN" (garis horizontal)
- **Social login**: Google + Apple buttons (bordered, icon + text)
- **Footer bawah**: "Belum punya akun? Daftar Sekarang."
- **Copyright**: "Hak Cipta © 2024 Universitas Alifah." + Kebijakan Privasi + Bantuan

> [!IMPORTANT]
> Untuk MVP, fitur social login (Google/Apple), Lupa Kata Sandi, dan Daftar Sekarang
> **TIDAK diimplementasikan**. Tombol/link bisa ditampilkan tapi non-fungsional atau dihilangkan.
> Sistem internal — akun dibuat oleh Admin.

### Panel Kanan (Branding)
- **Background**: Gradient navy to dark blue (mirip `#0F4C81` → `#0A2E52`)
- **Heading**: "Manajemen Surat Digital Universitas Alifah" (white, bold, centered)
- **Subtext**: "Kelola administrasi persuratan kampus secara efisien dan terintegrasi dalam satu platform cerdas."
- **Ilustrasi**: Floating cards mockup — browser window + stat card "1,248 Surat Terproses"
- **Style**: Glassmorphism cards with subtle shadows

---

## 2. Dashboard Overview

### Top Bar
- **Kiri**: Search bar — "Cari surat, nomor, atau perihal..." (rounded, icon search)
- **Kanan**: Notification bell (badge merah), Grid icon (:::), User avatar + nama + role
  - Contoh: "Budi Santoso — Admin Universitas"

### Page Header
- **Title**: "Dashboard Overview"
- **Subtitle**: "Ringkasan aktivitas surat menyurat Universitas Alifah."
- **Action buttons** (kanan): "Unduh Laporan" (outlined) + "+ Surat Baru" (filled navy)

### Stat Cards (4 kolom horizontal)
| Card | Angka | Icon | Footer |
|------|-------|------|--------|
| Total Surat Masuk | 1,284 | 📨 Mail icon (navy bg) | ↗ +12% bulan ini (hijau) |
| Menunggu Review | 45 | 🔔 Bell icon (orange bg) | ⚠ 12 butuh tindakan segera (merah) |
| Disposisi Aktif | 89 | 📋 Clipboard icon (purple bg) | 📍 Tersebar di 5 Fakultas |
| Surat Selesai | 1,150 | ✅ Check icon (teal bg) | ✅ 92% penyelesaian (hijau) |

- Setiap card: White bg, rounded corners, subtle shadow
- Angka: Very large bold font
- Icon: Rounded square with colored background

### Surat Masuk Terbaru (Main Content)
- **Header**: "Surat Masuk Terbaru" + link "Lihat Semua" (kanan)
- **Tabel columns**: NOMOR SURAT | PENGIRIM | PERIHAL | STATUS | AKSI
- **Status badges**:
  - `Menunggu Rektor` — orange bg, dark text
  - `Disposisi` — blue bg
  - `Menunggu Warek` — yellow bg
  - `Draft` — gray bg
  - `Selesai` — green bg
- Tidak ada border horizontal, hanya row separator tipis

### Aktivitas Terbaru (Sidebar Kanan)
- **Header**: "Aktivitas Terbaru" + more icon (⋮)
- **Timeline vertical** dengan colored dots:
  - 🔵 Blue dot — aktivitas normal
  - 🟢 Green dot — selesai
  - 🟡 Yellow dot — draft/pending
- **Format setiap entry**:
  - Timestamp (e.g., "10 menit yang lalu")
  - Deskripsi bold dengan nomor surat
  - Optional: sub-note dengan icon clipboard

---

## 3. Daftar Surat Masuk

### Page Header
- **Title**: "Daftar Surat Masuk"
- **Subtitle**: "Kelola dan pantau semua surat yang masuk ke instansi."

### Filter Bar
- **Search**: "Cari nomor, pengirim, atau perihal..." (rounded, icon search, left)
- **Buttons** (kanan): "≡ Filter" (outlined) + "📅 Periode" (outlined)

### Tabel
- **Columns**: (checkbox) | NO | PENGIRIM | PERIHAL | TANGGAL | STATUS | AKSI
- **Checkbox**: Setiap row punya checkbox untuk bulk action
- **NO**: Nomor urut (01, 02, 03...)
- **PENGIRIM**: Avatar circle (inisial, warna berbeda per user) + Nama
  - Avatar colors: coral, olive, purple, navy, maroon
- **TANGGAL**: Format "07 Nov 2025"
- **STATUS badges**:
  - `Baru` — blue bg, rounded pill
  - `Diproses` — orange bg
  - `Selesai` — gray bg
- **AKSI**: (implied action buttons/icons per row)

### Pagination
- **Info**: "Menampilkan 1 - 5 dari 45 surat"
- **Controls**: < | 1 | 2 | 3 | ... | 9 | >
- Active page: Navy filled circle, white text
- Inactive: Gray text

---

## 4. Registrasi Surat Masuk Baru (Form Input)

### Breadcrumb
- "Surat Masuk > Registrasi Surat Baru"

### Page Header
- **Title**: "Registrasi Surat Masuk Baru"
- **Subtitle**: "Isi detail form di bawah ini untuk mencatat surat masuk ke dalam sistem."
- **Buttons** (kanan): "Batal" (outlined) + "💾 Simpan Surat" (filled navy)

### Layout: 2 kolom (main ~65% | sidebar ~35%)

#### Main Column — Informasi Dasar
- **Section icon**: 📄 "Informasi Dasar"
- **Row 1**: Nomor Surat * (text input) | Tanggal Surat * (date picker)
- **Row 2**: Asal Surat (Instansi/Pengirim) * — full width
  - Placeholder: "Contoh: Kementerian Pendidikan dan Kebudayaan"
- **Row 3**: Perihal * — textarea
  - Placeholder: "Tuliskan perihal atau ringkasan isi surat"
- **Row 4**: Jenis Surat * (dropdown "Pilih jenis surat") | Tingkat Urgensi * (radio: Biasa ○ Segera ● Penting ○)

#### Main Column — Catatan Tambahan
- **Section icon**: ✏️ "Catatan Tambahan"
- **Textarea**: "Tambahkan catatan khusus jika diperlukan (opsional)"

#### Sidebar — Lampiran Dokumen
- **Section icon**: 📎 "Lampiran Dokumen"
- **Upload area**: Dashed border box
  - Cloud upload icon
  - "Pilih File atau Drag & Drop"
  - "PDF, JPG, PNG (Max 10MB)"
  - Button "Browse File" (outlined blue)

#### Sidebar — Metadata Sistem
- **Section icon**: ℹ️ "Metadata Sistem"
- **Read-only fields**:
  - Tanggal Diterima: "14 Mei 2026, 14:26 WIB" (auto-filled)
  - Penerima (Staff): Avatar + "Taufiq Hidayat" (current user)
  - No. Agenda/Registrasi: "AUTO-GENERATE" (badge gray)

---

## 5. Detail Surat & Disposisi

### Breadcrumb
- "Surat Masuk / Detail Surat"

### Page Header
- **Title**: "Detail Surat & Disposisi"
- **Subtitle**: "Kelola dan teruskan surat masuk ke unit terkait."
- **Button** (kanan): "🖨 Cetak Tanda Terima" (outlined)

### Layout: 2 kolom (main ~60% | sidebar ~40%)

#### Main Column — Informasi Surat
- **Card header**: ℹ️ "Informasi Surat" + Status badge (e.g., "Menunggu Disposisi" blue pill)
- **Fields** (label uppercase, value bold):
  - NOMOR SURAT: 045/UNIV-AL/XI/2023
  - TANGGAL SURAT: 10 November 2023
  - ASAL INSTANSI / PENGIRIM: Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi
  - PERIHAL: Undangan Rapat Koordinasi Perguruan Tinggi Swasta Wilayah X

#### Main Column — Pratinjau Dokumen
- **Card header**: 📎 "Pratinjau Dokumen" + Download icon (kanan)
- **Preview area**: Gray background, centered file icon
  - Filename: "Undangan_Rakor_LLDIKTI.pdf"
- Jika PDF, tampilkan embedded PDF viewer

#### Main Column — Riwayat Perjalanan Surat
- **Card header**: 🕐 "Riwayat Perjalanan Surat"
- **Timeline vertical**:
  - 🔵 Filled dot — completed step
    - Tanggal + waktu (bold): "11 Nov 2023, 09:00 WIB"
    - Title (bold): "Diterima oleh Admin Tata Usaha"
    - Description: "Surat fisik diterima dan didigitalisasi."
  - 🔵 Filled dot — completed step
    - "11 Nov 2023, 11:30"
    - "Diteruskan ke Wakil Rektor I"
    - "Menunggu peninjauan awal."
  - ⚪ Empty dot — current/pending step
    - "Saat ini" (hijau/green text)
    - "Menunggu Keputusan Rektor / Disposisi"

#### Sidebar — Form Disposisi Surat
- **Card header**: 📋 "Form Disposisi Surat"
- **Tujuan Disposisi** * — Checkbox list:
  - ☐ Fakultas Teknik — "Dekan & Jajaran"
  - ☐ Biro Administrasi Akademik (BAA) — "Kepala Biro"
  - ☐ Lembaga Penelitian dan Pengabdian Masyarakat (LPPM)
- **Instruksi Disposisi** * — Radio button pills:
  - ○ Tindak Lanjuti | ○ Harap Dihadiri
  - ○ Untuk Diketahui | ○ Lainnya...
- **Catatan Tambahan** — Textarea
  - Placeholder: "Ketik catatan atau instruksi spesifik di sini..."
- **Tingkat Urgensi** — Dropdown (Biasa ▾)
- **Action buttons**:
  - "Batal" (outlined, left)
  - "▶ Kirim Disposisi" (filled navy + icon, right)

---

## Komponen Reusable

### Sidebar Navigation
- **Logo area**: Icon "A" navy rounded + "SiSurat" + "Universitas Alifah"
- **CTA Button**: "+ Buat Surat Baru" — full width, navy bg, white text, rounded
- **Menu sections**:
  - MENU UTAMA:
    - 🏠 Dashboard
    - 📨 Surat Masuk (with badge counter, e.g., "9")
    - 📋 Disposisi
    - ✈️ Surat Keluar
    - 📊 Laporan
  - PENGATURAN:
    - 👤 Pengguna
    - ⚙️ Pengaturan
- **Footer**:
  - ❓ Bantuan
  - 🚪 Keluar (red text)
- **Active state**: Navy/blue filled background + white text + rounded
- **Hover state**: Light blue background
- **Icon style**: Outlined, 20px

### Avatar Inisial
- Circle 32-36px
- Background: Warna unik per user (derived from name)
- Text: 2 huruf inisial, white, bold, 12-14px
- Warna contoh: coral (#E57373), olive (#81C784), purple (#9575CD), navy (#42A5F5)

### Status Badge
- Rounded pill shape
- Padding: 4px 12px
- Font size: 12px, font-weight: 500
- Lihat mapping warna di `color-palette.md`

### Card Component
- Background: white
- Border: 1px solid #E5E7EB
- Border-radius: 12px (bukan 8px — dari mockup terlihat lebih rounded)
- Padding: 24px
- Shadow: subtle (0 1px 3px rgba(0,0,0,0.08))

### Section Header (dalam card)
- Icon (emoji/icon) + Title text
- Font: 16-18px, semi-bold
- Margin-bottom: 16px

### Input Fields
- Height: 40-44px
- Border: 1px solid #E5E7EB
- Border-radius: 8px
- Padding: 8px 12px
- Font: 14px
- Focus: Blue border (#4A90E2) + subtle shadow
- Label: 13px, font-weight 500, margin-bottom 6px
- Required indicator: Red asterisk *

### Top Bar / Header
- Background: White
- Height: ~56-64px
- Border-bottom: 1px solid #E5E7EB
- Left: Search bar atau breadcrumb
- Right: Notification bell + Grid icon + User info (avatar + name + role)
