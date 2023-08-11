<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\GalleryController;
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

Route::get('/', function () {
  // return view('welcome');
  return view('components.content.startpage');
})->name('startseite');

Route::get('/aktuelles', [NewsController::class, 'index'])->name('aktuelles');

Route::get('/verein', [ClubController::class, 'index'])->name('verein');

Route::get('/galerie', [GalleryController::class, 'index'])->name('galerie');

Route::get('/termine', function () {
  return view('components.content.event');
})->name('termine');

Route::get('/kontakt', function () {
  return view('components.content.contact');
})->name('kontakt');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
