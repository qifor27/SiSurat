# Sprint — Panduan

Folder ini berisi breakdown detail setiap sprint dari proyek SiSurat.
Setiap file menjelaskan goal, task, checklist, dependency, dan estimasi waktu.

## Daftar Sprint

| File | Sprint | Minggu | Total Task | Estimasi |
|------|--------|--------|-----------|----------|
| `s0-pra-sprint.md` | Pra-Sprint | 1–2 | 8 task | ~14 jam |
| `s1-crud-surat-masuk.md` | Sprint 1 | 3–4 | 9 task | ~16 jam |
| `s2-review-warek.md` | Sprint 2 | 5–6 | 7 task | ~12 jam |
| `s3-approve-rektor.md` | Sprint 3 | 7–8 | 7 task | ~12 jam |
| `s4-dashboard-polish.md` | Sprint 4 | 9–10 | 7 task | ~12 jam |

## Cara Menggunakan

1. Sebelum mengerjakan task, baca file sprint yang sesuai
2. Perhatikan **dependency** — kerjakan task sesuai urutan
3. Setelah selesai 1 task, centang checklist di sprint board (`to-do.blade.php`)
4. Setiap task punya ID unik: `S0-01`, `S1-01`, dst. — gunakan ID ini saat meminta AI

## Definition of Done per Sprint

- **Pra-Sprint**: Laravel jalan, login 3 role, semua tabel ada, seeder berhasil
- **Sprint 1**: Admin bisa input, upload, lihat daftar, ajukan ke Warek
- **Sprint 2**: Warek bisa teruskan/kembalikan, catatan tampil, ajukan ulang
- **Sprint 3**: Rektor approve, disposisi ke bagian, alur end-to-end jalan
- **Sprint 4**: Dashboard akurat, pencarian jalan, UI konsisten, siap UAT
