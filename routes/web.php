<?php

use Illuminate\Support\Facades\Route;
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

/*Route::get('/aktuelles', function (){
  return view('content.aktuelles');
})->name('aktuelles');*/
Route::get('/aktuelles', [NewsController::class, 'index'])->name('aktuelles');

Route::get('/verein', function(){
  return view('components.content.verein');
})->name('verein');

Route::get('/galerie', function(){
  return view('components.content.galerie');
})->name('galerie');

Route::get('/termine', function (){
  return view('components.content.termine');
})->name('termine');

Route::get('/kontakt', function(){
  return view('components.content.kontakt');
})->name('kontakt');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
