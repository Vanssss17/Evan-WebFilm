<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FilmController,
    AuthController,
    KritikController,
    ProfileController,
};

use App\Http\Controllers\Admin\FilmController as AdminFilmController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\CastController as AdminCastController;
use App\Http\Controllers\Admin\PeranController as AdminPeranController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::post('/movies/{film}/kritik', [KritikController::class, 'store'])
    ->middleware('auth')
    ->name('kritik.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.films.index'))->name('dashboard');
    Route::resource('films', AdminFilmController::class)->except(['show']);
    Route::resource('genres', AdminGenreController::class)->except(['show']);
    Route::resource('casts', AdminCastController::class)->except(['show']);
    Route::get('films/{film}/perans', [AdminPeranController::class, 'index'])->name('films.perans.index');
    Route::post('films/{film}/perans', [AdminPeranController::class, 'store'])->name('films.perans.store');
    Route::get('perans/{peran}/edit', [AdminPeranController::class, 'edit'])->name('perans.edit');
    Route::put('perans/{peran}', [AdminPeranController::class, 'update'])->name('perans.update');
    Route::delete('perans/{peran}', [AdminPeranController::class, 'destroy'])->name('perans.destroy');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
});