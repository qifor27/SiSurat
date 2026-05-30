# SiSurat — Design Guidelines

## Arah Desain

Modern minimal admin dashboard — clean, readable, professional.
Gaya seperti Linear, Notion, Vercel dashboard.

### Prinsip
- Clean & Minimal — whitespace dan keterbacaan
- Professional — terlihat seperti sistem produksi
- Tidak "AI banget" — tanpa neon atau emoticon berlebihan
- Konsisten — semua halaman ikuti design system
- Data placeholder Bahasa Indonesia

---

## Warna (Identitas Universitas Alifah)

| Peran | Hex |
|-------|-----|
| Primary | `#0F4C81` |
| Secondary | `#2B6CB0` |
| Accent | `#4A90E2` |
| Background | `#F5F7FA` |
| Surface | `#FFFFFF` |
| Border | `#E5E7EB` |
| Text Primary | `#1F2937` |
| Text Secondary | `#6B7280` |
| Success | `#16A34A` |
| Warning | `#D97706` |
| Danger | `#DC2626` |

Detail lengkap: `design/color-palette.md`

---

## Typography

| Elemen | Font | Size | Weight |
|--------|------|------|--------|
| Body | Inter / Plus Jakarta Sans | 14px | 400 |
| Sidebar | Inter | 13px | 500 |
| Card title | Inter | 15px | 600 |
| Heading | Inter | 20px | 700 |
| Code/ID | JetBrains Mono | 12px | 400 |

---

## Layout

- **Sidebar**: Fixed left 240px, navy background, logo atas, user bawah
- **Top bar**: Search/breadcrumb kiri, notif+avatar kanan, white, border-bottom
- **Content**: Background `#F5F7FA`, card white radius 12px

---

## Status Badges

| Status | Background | Text |
|--------|-----------|------|
| Draft | `#F3F4F6` | `#6B7280` |
| Baru | `#DBEAFE` | `#2B6CB0` |
| Menunggu Warek | `#FEF3C7` | `#D97706` |
| Menunggu Rektor | `#FEF3C7` | `#D97706` |
| Menunggu Disposisi | `#DBEAFE` | `#2B6CB0` |
| Diproses | `#FEF3C7` | `#D97706` |
| Disposisi | `#DBEAFE` | `#2B6CB0` |
| Selesai | `#D1FAE5` | `#16A34A` |
| Dikembalikan | `#FEE2E2` | `#DC2626` |

---

## Komponen

- **Input**: 40-44px height, border `#E5E7EB`, radius 8px
- **Button Primary**: Navy fill, white text, radius 8px
- **Button Secondary**: White fill, gray border, radius 8px
- **Table Row**: 48px height, bottom border only
- **Card**: White, 1px border, radius 12px, padding 24px, subtle shadow

---

## Halaman (Mockup dari Google Stitch)

| # | Halaman | Deskripsi |
|---|---------|-----------|
| 1 | **Login** | Split screen — form kiri, branding navy kanan |
| 2 | **Dashboard Overview** | 4 stat cards + tabel terbaru + timeline aktivitas |
| 3 | **Daftar Surat Masuk** | Tabel dengan search, filter, pagination |
| 4 | **Registrasi Surat Baru** | Form 2 kolom + upload + metadata |
| 5 | **Detail Surat & Disposisi** | Info surat + preview + timeline + form disposisi |

Spesifikasi UI lengkap: `design/ui-specifications.md`

---

## Login

- HANYA login, TIDAK ADA register (sistem internal)
- Akun dibuat oleh Admin
- Split screen: Form (kiri) + Branding panel navy (kanan)
- Fields: Email + Password (toggle visibility) + "Ingat Saya" + Tombol "Masuk"
- Social login (Google/Apple) — non-fungsional di MVP
