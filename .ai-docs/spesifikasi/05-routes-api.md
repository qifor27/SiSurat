# Routes & Endpoints — SiSurat

## Route Groups

### Public (Tanpa Auth)
| Method | URL | Controller | Name | Sprint |
|--------|-----|-----------|------|--------|
| GET | `/` | - | home | - |
| GET | `/login` | AuthenticatedSessionController | login | S0 |
| POST | `/login` | AuthenticatedSessionController | login.store | S0 |
| POST | `/logout` | AuthenticatedSessionController | logout | S0 |

### Admin (`/admin/*` — middleware: auth, role:admin)
| Method | URL | Controller@Method | Name | Sprint |
|--------|-----|-------------------|------|--------|
| GET | `/admin/dashboard` | DashboardController@index | admin.dashboard | S0/S4 |
| GET | `/admin/surat-masuk` | SuratMasukController@index | admin.surat-masuk.index | S1 |
| GET | `/admin/surat-masuk/create` | SuratMasukController@create | admin.surat-masuk.create | S1 |
| POST | `/admin/surat-masuk` | SuratMasukController@store | admin.surat-masuk.store | S1 |
| GET | `/admin/surat-masuk/{id}` | SuratMasukController@show | admin.surat-masuk.show | S1 |
| GET | `/admin/surat-masuk/{id}/edit` | SuratMasukController@edit | admin.surat-masuk.edit | S1 |
| PUT | `/admin/surat-masuk/{id}` | SuratMasukController@update | admin.surat-masuk.update | S1 |
| DELETE | `/admin/surat-masuk/{id}` | SuratMasukController@destroy | admin.surat-masuk.destroy | S1 |
| PATCH | `/admin/surat-masuk/{id}/ajukan` | SuratMasukController@ajukan | admin.surat-masuk.ajukan | S1 |

### Wakil Rektor (`/warek/*` — middleware: auth, role:wakil_rektor)
| Method | URL | Controller@Method | Name | Sprint |
|--------|-----|-------------------|------|--------|
| GET | `/warek/dashboard` | DashboardController@index | warek.dashboard | S0/S4 |
| GET | `/warek/surat-masuk` | SuratMasukController@index | warek.surat-masuk.index | S2 |
| GET | `/warek/surat-masuk/{id}` | SuratMasukController@show | warek.surat-masuk.show | S2 |
| PATCH | `/warek/surat-masuk/{id}/teruskan` | SuratMasukController@teruskan | warek.surat-masuk.teruskan | S2 |
| PATCH | `/warek/surat-masuk/{id}/kembalikan` | SuratMasukController@kembalikan | warek.surat-masuk.kembalikan | S2 |

### Rektor (`/rektor/*` — middleware: auth, role:rektor)
| Method | URL | Controller@Method | Name | Sprint |
|--------|-----|-------------------|------|--------|
| GET | `/rektor/dashboard` | DashboardController@index | rektor.dashboard | S0/S4 |
| GET | `/rektor/surat-masuk` | SuratMasukController@index | rektor.surat-masuk.index | S3 |
| GET | `/rektor/surat-masuk/{id}` | SuratMasukController@show | rektor.surat-masuk.show | S3 |
| PATCH | `/rektor/surat-masuk/{id}/approve` | SuratMasukController@approve | rektor.surat-masuk.approve | S3 |
| PATCH | `/rektor/surat-masuk/{id}/kembalikan` | SuratMasukController@kembalikan | rektor.surat-masuk.kembalikan | S3 |
| POST | `/rektor/surat-masuk/{id}/disposisi` | DisposisiController@store | rektor.disposisi.store | S3 |
