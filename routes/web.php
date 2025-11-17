<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes - Homepage
Route::get('/', [InformasiController::class, 'index'])->name('home');

// Public routes - Galeri
Route::get('/public/galeri', [GaleriController::class, 'publicIndex'])->name('public.galeri');
Route::get('/galeri/increment-view/{id}', [GaleriController::class, 'incrementView'])->name('galeri.increment-view');
Route::post('/galeri/{id}/like', [GaleriController::class, 'toggleLike'])->name('galeri.like');
Route::post('/galeri/{id}/dislike', [GaleriController::class, 'toggleDislike'])->name('galeri.dislike');
Route::post('/galeri/{id}/comment', [GaleriController::class, 'addComment'])->name('galeri.comment');
Route::get('/galeri/{id}/comments', [GaleriController::class, 'getComments'])->name('galeri.comments');
Route::get('/galeri/{id}/download', [GaleriController::class, 'download'])->name('galeri.download');

// Public routes - Informasi
Route::get('/public/informasi', [InformasiController::class, 'index'])->name('public.informasi');

// Public routes - Agenda
Route::get('/public/agenda', [AgendaController::class, 'publicIndex'])->name('public.agenda');

// User Authentication routes
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login.post');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register.post');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Protected admin routes (require admin authentication)
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        
        Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
        Route::get('/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
        Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('admin.galeri.update');
        Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
        
        Route::get('/galeri/kategori', [GaleriController::class, 'kategoriIndex'])->name('admin.galeri.kategori');
        Route::post('/galeri/kategori', [GaleriController::class, 'kategoriStore'])->name('admin.galeri.kategori.store');
        Route::put('/galeri/kategori/{id}', [GaleriController::class, 'kategoriUpdate'])->name('admin.galeri.kategori.update');
        Route::delete('/galeri/kategori/{id}', [GaleriController::class, 'kategoriDestroy'])->name('admin.galeri.kategori.destroy');
        
        Route::get('/informasi', [InformasiController::class, 'index'])->name('admin.informasi');
        Route::put('/informasi', [InformasiController::class, 'updateInformasi'])->name('admin.informasi.update');
        
        Route::get('/agenda', [AgendaController::class, 'adminIndex'])->name('admin.agenda');
        
        Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
    });
});

