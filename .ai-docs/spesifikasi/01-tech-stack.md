# Tech Stack — SiSurat

| Kategori | Teknologi | Versi | Catatan |
|----------|-----------|-------|---------|
| Framework | Laravel | ^13.7 | Sesuai composer.json, fresh install |
| PHP | PHP | 8.3+ | Minimum requirement Laravel 13 |
| Database | MySQL | 8.x | Database name: `sisurat` |
| Auth | Laravel Breeze | latest | Template: Blade (bukan API/Inertia) |
| Roles | Spatie Laravel Permission | latest | Trait HasRoles di model User |
| CSS | Tailwind CSS | 4.x | Via `@tailwindcss/vite` plugin |
| Build Tool | Vite | 8.x | Dev server: `npm run dev` |
| Font | Plus Jakarta Sans | Google Fonts | Font utama UI |
| Font Code | JetBrains Mono | Google Fonts | Untuk nomor surat, badge, code |
| Testing | Pest PHP | 4.x | Dev dependency |
| Linting | Laravel Pint | 1.x | PSR-12 coding standard |

## Package yang Akan Diinstall

### Composer (Production)
```
laravel/framework: ^13.7
laravel/tinker: ^3.0
laravel/breeze: (setelah install)
spatie/laravel-permission: (setelah install)
```

### Composer (Dev)
```
fakerphp/faker: ^1.23
laravel/pail: ^1.2.5
laravel/pint: ^1.27
pestphp/pest: ^4.7
```

### NPM
```
tailwindcss: ^4.0.0
@tailwindcss/vite: ^4.0.0
vite: ^8.0.0
laravel-vite-plugin: ^3.1
```

## Yang TIDAK Digunakan

- ❌ React/Vue/Inertia — pakai Blade saja
- ❌ REST API — server-side rendering
- ❌ Redis — pakai database cache
- ❌ Docker — development di localhost
- ❌ DomPDF — belum di MVP, mungkin Sprint 4
