<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogpostController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsletterController;
use App\Http\Middleware\DevelopmentMiddleware;
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

Route::get('/verein', [ClubController::class, 'index'])->name('verein');

Route::get('/verein/{subpage?}', [ClubController::class, 'show'])->name('verein/name')->where('subpage', '.*');

Route::get('/galerie', [AlbumController::class, 'index'])->name('galerie');

// Route für die Anzeige der Medien in einem Album
Route::get('/galerie/{albumName}', [AlbumController::class, 'show'])->name('galerie/name');

Route::get('/termine', [EventController::class, 'index'])->name('termine');

Route::get('/kontakt', function () {
    return view('components.content.contact');
})->name('kontakt');

Route::middleware([DevelopmentMiddleware::class])->get('/debug', function () {
    return view('components.content.test');
})->name('test');

Route::get('newsletter/unsubscribe/{email}/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('newsletter/verify/{token}', [NewsletterController::class, 'verifySubscription'])->name('newsletter.verify');
Route::get('newsletter/send-verification/{email}', [NewsletterController::class, 'resend'])->name('newsletter.resend');

Route::get('impressum', function () {
    return view('components.content.imprint');
})->name('impressum');
Route::get('datenschutz', function () {
    return view('components.content.privacy');
})->name('datenschutz');

// Registrierung

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/blogpost', [BlogpostController::class, 'store'])->name('blogpost.create');
    Route::delete('/blogpost', [BlogpostController::class, 'destroy'])->name('blogpost.delete');
    Route::post('/blogpost/archive', [BlogpostController::class, 'archive'])->name('blogpost.archive');

    Route::post('/media', [MediaController::class, 'store'])->name('media.create');
    Route::delete('/media', [MediaController::class, 'destroy'])->name('media.delete');

    Route::post('/album', [AlbumController::class, 'store'])->name('album.create');
    Route::patch('/album', [AlbumController::class, 'update'])->name('album.update');
    Route::delete('/album', [AlbumController::class, 'destroy'])->name('album.delete');

    Route::post('/event', [EventController::class, 'store'])->name('event.create');
    Route::patch('/event', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event', [EventController::class, 'destroy'])->name('event.delete');

    Route::post('/subpage', [ClubController::class, 'store'])->name('subpage.create');
    Route::patch('/subpage', [ClubController::class, 'update'])->name('subpage.update');
    Route::delete('/subpage', [ClubController::class, 'destroy'])->name('subpage.delete');

    // Userverwaltung
    // User - Einladung
    Route::post('invitations', [InvitationController::class, 'store'])->name('storeInvitation');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
