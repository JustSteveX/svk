<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogpostController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

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

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.create');
    Route::patch('/contact', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact', [ContactController::class, 'destroy'])->name('contact.delete');

    // Userverwaltung
    // User - Einladung
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitation.create');
    Route::patch('/invitations', [InvitationController::class, 'update'])->name('invitation.update');
    Route::delete('/invitations', [InvitationController::class, 'destroy'])->name('invitation.delete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
