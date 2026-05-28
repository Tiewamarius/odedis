<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\AdminController;
use Illuminate\Support\Str;
use App\Http\Controllers\AdminAuth\RegisteredAdminController;
use App\Http\Controllers\AdminAuth\AdminAuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\AdminPasswordResetLinkController;
use App\Http\Controllers\AdminAuth\AdminNewPasswordController;

/* ====================== AUTH ADMIN (GUEST) ====================== */

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredAdminController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])->name('admin.password.request');
    Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])->name('admin.password.email');

    Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])->name('admin.password.reset');
    Route::post('reset-password', [AdminNewPasswordController::class, 'store'])->name('admin.password.store');
});


/* ====================== ADMIN AUTHENTIFIÉ ====================== */
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    /* ================= DASHBOARD ================= */
    Route::get('dashboard', [AdminController::class, 'homes'])
        ->name('admin.dashboard');


    /* ================= ADMINS ================= */
    Route::prefix('admins')->group(function () {

        Route::get('/', [AdminController::class, 'admins'])
            ->name('admin.admins.index');

        Route::get('/create', [AdminController::class, 'createAdmin'])
            ->name('admin.admins.create');

        Route::post('/', [AdminController::class, 'storeAdmin'])
            ->name('admin.admins.store');

        Route::get('/{id}/edit', [AdminController::class, 'editAdmin'])
            ->name('admin.admins.edit');

        Route::put('/{id}', [AdminController::class, 'updateAdmin'])
            ->name('admin.admins.update');

        Route::delete('/{id}', [AdminController::class, 'destroyAdmin'])
            ->name('admin.admins.destroy');
    });


    /* ================= USERS ================= */
    Route::prefix('users')->group(function () {

        Route::get('/', [AdminController::class, 'users'])
            ->name('admin.users.index');

        Route::get('/create', [AdminController::class, 'createUser'])
            ->name('admin.users.create');

        Route::post('/', [AdminController::class, 'storeUser'])
            ->name('admin.users.store');

        Route::get('/{id}/edit', [AdminController::class, 'editUser'])
            ->name('admin.users.edit');

        Route::put('/{id}', [AdminController::class, 'updateUser'])
            ->name('admin.users.update');

        Route::delete('/{id}', [AdminController::class, 'destroyUser'])
            ->name('admin.users.destroy');
    });


    /* ================= RESIDENCES ================= */
    Route::prefix('residences')->group(function () {

        Route::get('/', [AdminController::class, 'residences'])
            ->name('admin.residences.index');

        Route::get('/admin/residences/{id}/calendar', [AdminController::class, 'calendar'])
            ->name('admin.residences.calendar');

        Route::get('/create', [AdminController::class, 'createResidence'])
            ->name('admin.residences.create');

        Route::post('/', [AdminController::class, 'storeResidence'])
            ->name('admin.residences.store');

        Route::get('/{residence}/edit', [AdminController::class, 'editResidence'])
            ->name('admin.residences.edit');

        Route::put('/{residence}', [AdminController::class, 'updateResidence'])
            ->name('admin.residences.update');

        Route::delete('/{residence}', [AdminController::class, 'destroyResidence'])
            ->name('admin.residences.destroy');
    });


    /* ================= BOOKINGS ================= */
    Route::prefix('bookings')->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.bookings.index');

        Route::get('/create', [AdminController::class, 'createBooking'])
            ->name('admin.bookings.create');

        Route::post('/', [AdminController::class, 'storeBooking'])
            ->name('admin.bookings.store');

        Route::get('/{booking}/details', [AdminController::class, 'bookingDetails'])
            ->name('admin.bookings.details');

        Route::get('/{booking}/edit', [AdminController::class, 'editBooking'])
            ->name('admin.bookings.edit');

        Route::put('/{booking}', [AdminController::class, 'updateBooking'])
            ->name('admin.bookings.update');

        Route::delete('/{booking}', [AdminController::class, 'destroyBooking'])
            ->name('admin.bookings.destroy');
    });


    /* ================= CLIENTS ================= */
    Route::prefix('clients')->group(function () {

        Route::get('/', [AdminController::class, 'clients'])
            ->name('admin.clients.index');

        Route::get('/{client}', [AdminController::class, 'showClient'])
            ->name('admin.clients.show');

        Route::delete('/{client}', [AdminController::class, 'destroyClient'])
            ->name('admin.clients.destroy');

        Route::get('/{id}/bookings', [AdminController::class, 'clientBookings'])
            ->name('admin.clients.bookings');
    });


    /* ================= PAYMENTS ================= */
    Route::prefix('payments')->group(function () {

        Route::get('/', [AdminController::class, 'payments'])
            ->name('admin.payments.index');

        Route::get('/{payment}', [AdminController::class, 'showPayment'])
            ->name('admin.payments.show');
    });


    /* ================= PROFILE ================= */
    Route::get('profile', [AdminController::class, 'profile'])
        ->name('admin.profile');

    Route::put('profile', [AdminController::class, 'updateProfile'])
        ->name('admin.profile.update');


    /* ================= AUTRES ================= */
    Route::get('link', [AdminController::class, 'link'])
        ->name('admin.link');

    Route::get('reviewslink/{booking}', [AdminController::class, 'createReviewLink'])
        ->name('admin.reviewslink');


    /* ================= REPORTS ================= */
    Route::get('reports', [AdminController::class, 'reports'])
        ->name('admin.reports.index');

    Route::get('reports/{report}', [AdminController::class, 'showReport'])
        ->name('admin.reports.show');


    /* ================= LOGOUT ================= */
    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});
