<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogpostController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::post('/blogpost', [BlogpostController::class, 'store'])->name('blogpost.create')->middleware('check.permissions:manage_blogposts');
    Route::delete('/blogpost', [BlogpostController::class, 'destroy'])->name('blogpost.delete')->middleware('check.permissions:manage_blogposts');
    Route::post('/blogpost/archive', [BlogpostController::class, 'archive'])->name('blogpost.archive')->middleware('check.permissions:manage_blogposts');

    Route::post('/media', [MediaController::class, 'store'])->name('media.create')->middleware('check.permissions:manage_media');
    Route::patch('/media', [MediaController::class, 'move'])->name('media.move')->middleware('check.permissions:manage_media');
    Route::put('/media', [MediaController::class, 'update'])->name('media.update')->middleware('check.permissions:manage_media');
    Route::delete('/media/delete', [MediaController::class, 'destroy'])->name('media.delete')->middleware('check.permissions:manage_media');
    Route::post('/sychronize', [MediaController::class, 'synchronize'])->name('media.synchronize')->middleware('check.permissions:sync_application_videos');

    Route::post('/album', [AlbumController::class, 'store'])->name('album.create')->middleware('check.permissions:manage_media');
    Route::patch('/album', [AlbumController::class, 'update'])->name('album.update')->middleware('check.permissions:manage_media');
    Route::delete('/album', [AlbumController::class, 'destroy'])->name('album.delete')->middleware('check.permissions:manage_media');

    Route::post('/event', [EventController::class, 'store'])->name('event.create')->middleware('check.permissions:manage_events');
    Route::patch('/event', [EventController::class, 'update'])->name('event.update')->middleware('check.permissions:manage_events');
    Route::delete('/event', [EventController::class, 'destroy'])->name('event.delete')->middleware('check.permissions:manage_events');

    Route::post('/subpage', [ClubController::class, 'store'])->name('subpage.create')->middleware('check.permissions:manage_club_pages');
    Route::patch('/subpage', [ClubController::class, 'update'])->name('subpage.update')->middleware('check.permissions:manage_club_pages');
    Route::delete('/subpage', [ClubController::class, 'destroy'])->name('subpage.delete')->middleware('check.permissions:manage_club_pages');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.create')->middleware('check.permissions:manage_contacts');
    Route::patch('/contact', [ContactController::class, 'update'])->name('contact.update')->middleware('check.permissions:manage_contacts');
    Route::delete('/contact', [ContactController::class, 'destroy'])->name('contact.delete')->middleware('check.permissions:manage_contacts');

    Route::post('/config', [HomeController::class, 'setConfig'])->name('config.set')->middleware('check.permissions:manage_startpage');

    // Rollenverwaltung
    Route::post('/role', [RoleController::class, 'store'])->name('role.create')->middleware('check.permissions:manage_roles');

    // User - Einladung
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitation.create')->middleware('check.permissions:manage_users');
    Route::patch('/invitations', [InvitationController::class, 'update'])->name('invitation.update')->middleware('check.permissions:manage_users');
    Route::delete('/invitations', [InvitationController::class, 'destroy'])->name('invitation.delete')->middleware('check.permissions:manage_users');

    Route::delete('/newsletter', [NewsletterController::class, 'destroy'])->name('newsletter.clear')->middleware('check.permissions:manage_subscribers');

    Route::put('/user', [RegisteredUserController::class, 'update'])->name('user.update.role')->middleware('check.permissions:manage_users');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
