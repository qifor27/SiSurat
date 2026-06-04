# System Design - SiSurat (Universitas Alifah) v2.0

## Design Philosophy
Redesign Sistem Informasi Persuratan Universitas Alifah bertujuan untuk menciptakan pengalaman pengguna kelas **Enterprise**. Desainnya berfokus pada:
- **Modern & Corporate:** Layout bersih, penggunaan white space yang optimal, tidak menggunakan elemen playful berlebihan (seperti emoji).
- **Efisiensi:** Akses cepat ke fungsi utama menggunakan sidebar terstruktur dan global header.
- **Konsistensi:** Penggunaan Design Tokens untuk warna, tipografi, dan ukuran.

## Color System
Warna utama menggunakan nuansa Indigo-700 yang memberikan kesan profesional, akademis, dan terpercaya.

| Token | Hex | Penggunaan |
|-------|-----|------------|
| `--color-primary` | `#4338CA` | Button primary, active states, border focus, Sidebar BG |
| `--color-primary-hover` | `#3730A3` | Hover state untuk button primary |
| `--color-primary-light` | `#EEF2FF` | Background active menu, badge background |
| `--color-success` | `#10B981` | Status "Selesai", notifikasi sukses |
| `--color-warning` | `#F59E0B` | Status "Menunggu", urgensi "Segera" |
| `--color-danger` | `#EF4444` | Status "Dikembalikan", aksi hapus |
| `--color-bg` | `#F8FAFC` | Background aplikasi (body) |
| `--color-card` | `#FFFFFF` | Background cards, header |
| `--color-border` | `#E2E8F0` | Border form, divider |
| `--color-text` | `#0F172A` | Teks utama (Heading, body) |
| `--color-text-muted` | `#64748B` | Subtitle, placeholder, label non-aktif |

## Typography
Seluruh aplikasi menggunakan **Inter** (`wght@300;400;500;600;700`) sebagai standar de-facto tipografi sistem informasi global.
- **H1:** 24px (text-2xl), Bold
- **H2:** 20px (text-xl), SemiBold
- **Body:** 14px (text-sm), Regular
- **Small/Badge:** 12px (text-xs), Medium/SemiBold

## Component Architecture

### Layout System
Menggunakan pola **Fixed Sidebar + Header**.
- **Sidebar:** Kiri (w-64), static di desktop, off-canvas drawer di mobile. Background Indigo (`#4338CA`).
- **Header:** Atas (h-20), fixed, berisi global search, notifikasi, dan user dropdown.
- **Main Area:** Scrollable y-axis dengan background abu-abu muda (`#F8FAFC`).

### Card System (`.card-enterprise`)
Setiap block informasi menggunakan card dengan gaya premium:
- Background: White
- Border Radius: 18px (card biasa), 20px (card besar)
- Border: 1px solid `#E2E8F0`
- Shadow: `0 4px 16px rgba(15, 23, 42, 0.05)`

### Form System (`.input-enterprise`)
Input dirancang agar besar dan mudah diklik:
- Height: 48px
- Border Radius: 12px
- Focus: Border ganti ke primary (`#4338CA`) dengan ring shadow tipis tebal (4px).

### Button System
- **Primary (`.btn-primary`):** Solid background indigo, teks putih, hover effect.
- **Secondary (`.btn-secondary`):** Background putih, teks hitam, border abu-abu.
- Keduanya memiliki border-radius 12px dan tinggi 44px.

### Icon System
Emoji (❌) **DILARANG** digunakan. Seluruh icon aplikasi WAJIB menggunakan **Lucide Icons** (https://lucide.dev) via CDN di `<head>`.

## Responsive Rules
- **Desktop (≥ 1280px / xl):** Sidebar terlihat penuh (expanded).
- **Tablet / Mobile (< 1280px):** Sidebar disembunyikan (hidden) dan diakses melalui hamburger menu di header. Tabel harus di-wrap dalam container `overflow-x-auto`.

## Laravel Blade Structure
Untuk kemudahan reusability, komponen-komponen UI telah diabstraksi menjadi Blade Components:
- `x-sidebar`
- `x-header`
- `x-page-header`
- `x-stat-card`
- `x-badge`
- `x-empty-state`
