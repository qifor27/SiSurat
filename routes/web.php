<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // surat Masuk //
    Route::resource('surat-masuk', SuratMasukController::class)
        ->except(['destroy']);

    Route::patch('surat-masuk/{suratMasuk}/ajukan',
        [SuratMasukController::class, 'ajukan']
    )->name('surat-masuk.ajukan');

});

Route::middleware(['auth', 'verified', 'role:wakil_rektor'])->prefix('warek')->name('warek.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\WakilRektor\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/surat-masuk', [\App\Http\Controllers\WakilRektor\SuratMasukController::class,'index'])
        ->name('surat-masuk.index');

    Route::get('/surat-masuk/{suratMasuk}',[\App\Http\Controllers\WakilRektor\SuratMasukController::class,'show'])
        ->name('surat-masuk.show');

    Route::patch('/surat-masuk/{suratMasuk}/teruskan',[\App\Http\Controllers\WakilRektor\SuratMasukController::class,'teruskan'])
        ->name('surat-masuk.teruskan');

    Route::patch('/surat-masuk/{suratMasuk}/kembalikan',[\App\Http\Controllers\WakilRektor\SuratMasukController::class,'kembalikan'])
        ->name('surat-masuk.kembalikan');
    
});

Route::middleware(['auth', 'verified', 'role:rektor'])->prefix('rektor')->name('rektor.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Rektor\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/surat-masuk',[\App\Http\Controllers\Rektor\SuratMasukController::class,'index'])
      ->name('surat-masuk.index');
    Route::get('/surat-masuk/{suratMasuk}',[\App\Http\Controllers\Rektor\SuratMasukController::class,'show'])
      ->name('surat-masuk.show');
    Route::patch('/surat-masuk/{suratMasuk}/approve', [\App\Http\Controllers\Rektor\SuratMasukController::class,'approve'])
      ->name('surat-masuk.approve');
    Route::patch('/surat-masuk/{suratMasuk}/kembalikan',[\App\Http\Controllers\Rektor\SuratMasukController::class,'kembalikan'])
      ->name('surat-masuk.kembalikan');
    Route::post('/surat-masuk/{suratMasuk}/disposisi',[\App\Http\Controllers\Rektor\SuratMasukController::class,'storeDisposisi'])
      ->name('disposisi.store');
    
});

// Route Grup khusus Bagian Terkait
Route::middleware(['auth', 'verified', 'role:bagian_terkait'])->prefix('bagian')->name('bagian.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Bagian\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
