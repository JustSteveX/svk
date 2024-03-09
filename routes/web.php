<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogpostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('startseite');

Route::get('/aktuelles', [BlogpostController::class, 'index'])->name('aktuelles');

Route::get('/verein')->name('verein');

Route::get('/galerie', [AlbumController::class, 'index'])->name('galerie');

// Route für die Anzeige der Medien in einem Album
Route::get('/galerie/{albumName}', [AlbumController::class, 'show'])->name('galerie/name');

Route::get('/termine', function () {
    return view('components.content.event');
})->name('termine');

Route::get('/kontakt', function () {
    return view('components.content.contact');
})->name('kontakt');

Route::get('/kontakt', function () {
    return view('components.content.contact');
})->name('kontakt');

Route::get('/debug', function () {
    return view('components.content.test');
})->name('test');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('blogpost', [BlogpostController::class, 'store'])->name('blogpost.create');
    Route::delete('blogpost', [BlogpostController::class, 'destroy'])->name('blogpost.delete');

    Route::post('/media', [MediaController::class, 'store'])->name('media.create');
    Route::delete('/media', [MediaController::class, 'destroy'])->name('media.delete');

    Route::post('/album', [AlbumController::class, 'store'])->name('album.create');
    Route::patch('/album', [AlbumController::class, 'update'])->name('album.update');
    Route::delete('/album', [AlbumController::class, 'destroy'])->name('album.delete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
