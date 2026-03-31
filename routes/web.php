<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PetugasController;


/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'landing')->name('landing');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});

Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin')->name('dashboard.admin');

    Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])
        ->middleware('role:admin,petugas')->name('dashboard.petugas');

    Route::get('/dashboard/user', [DashboardController::class, 'user'])
        ->middleware('role:user')->name('dashboard.user');
});

/*
|--------------------------------------------------------------------------
| BOOK (SEMUA ROLE LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::get('/books/{id}', [BookController::class, 'show'])
        ->name('books.show');
});

/*
|--------------------------------------------------------------------------
| REVIEW
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/reviews', [ReviewController::class, 'index'])
        ->name('reviews.index');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('reviews.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN + PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,petugas'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | BOOK MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::get('/books', [BookController::class, 'adminIndex'])
            ->name('admin.books.index');

        Route::get('/books/create', [BookController::class, 'create'])
            ->name('admin.books.create');

        Route::post('/books', [BookController::class, 'store'])
            ->name('admin.books.store');

        Route::get('/books/{id}/edit', [BookController::class, 'edit'])
            ->name('admin.books.edit');

        Route::put('/books/{id}', [BookController::class, 'update'])
            ->name('admin.books.update');

        Route::delete('/books/{id}', [BookController::class, 'destroy'])
            ->name('admin.books.destroy');

        Route::post('/books/{id}/tambah-stok',
            [BookController::class, 'tambahStok'])
            ->name('books.tambahStok');

        /*
        |--------------------------------------------------------------------------
        | KATEGORI & USER
        |--------------------------------------------------------------------------
        */
        Route::resource('kategori', KategoriController::class);
        Route::resource('users', UserController::class);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN
        |--------------------------------------------------------------------------
        */
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])
            ->name('laporan.cetak');

        /*
        |--------------------------------------------------------------------------
        | PEMINJAMAN ADMIN
        |--------------------------------------------------------------------------
        */
        Route::get('/peminjaman',
            [PeminjamanController::class, 'index'])
            ->name('admin.peminjaman.index');

        Route::post('/peminjaman/{id}/setujui',
            [PeminjamanController::class,'setujui'])
            ->name('peminjaman.setujui');

        Route::post('/peminjaman/{id}/tolak',
            [PeminjamanController::class,'tolak'])
            ->name('peminjaman.tolak');

        Route::post('/pengembalian/{id}/setujui',
            [PeminjamanController::class,'setujuiPengembalian'])
            ->name('pengembalian.setujui');

        Route::post('/pengembalian/{id}/tolak',
            [PeminjamanController::class,'tolakPengembalian'])
            ->name('pengembalian.tolak');

        /*
        |--------------------------------------------------------------------------
        | RIWAYAT
        |--------------------------------------------------------------------------
        */
        Route::get('/riwayat/peminjaman',
            [PeminjamanController::class, 'riwayatPeminjaman'])
            ->name('admin.riwayat.peminjaman');

        Route::get('/riwayat/pengembalian',
            [PeminjamanController::class, 'riwayatPengembalian'])
            ->name('admin.riwayat.pengembalian');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::resource('petugas', PetugasController::class)
            ->parameters(['petugas' => 'petugas']);
});

/*
|--------------------------------------------------------------------------
| USER ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

  // Halaman membuat review untuk buku tertentu
    Route::get('/reviews/create/{book}', [ReviewController::class, 'create'])
        ->name('review.create');

    // Menyimpan review
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('review.store');
        

    Route::resource('peminjaman', PeminjamanController::class)
        ->only(['index', 'create', 'store']);

    Route::get('/peminjaman/{id}/bukti',
        [PeminjamanController::class, 'bukti'])
        ->name('user.bukti');

    Route::post('/pengembalian/{id}/ajukan',
        [PeminjamanController::class,'ajukanPengembalian'])
        ->name('pengembalian.ajukan');

    Route::get('/koleksi', [KoleksiController::class, 'index'])
        ->name('koleksi.index');

    Route::post('/koleksi/{book}', [KoleksiController::class, 'store'])
        ->name('koleksi.store');

    Route::delete('/koleksi/{book}', [KoleksiController::class, 'destroy'])
        ->name('koleksi.destroy');

    

});