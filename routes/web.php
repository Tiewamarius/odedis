<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Models\Residence;



Route::get('/', [HomeController::class, 'HomePage']);

// Routes d'authentification sociale avec Google
Route::get('/auth/google/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.google.callback');


// Route pour la page des favoris
Route::get('/favoris', function () {
    return view('favorites.favorites');
})->name('favorites.index');




// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Routes de profil utilisateur
    Route::get('/homeUser', [ProfileController::class, 'homeUser'])->name('profile.homeUser');


    // Route pour la review
    Route::post('/residences/{residence}/review', [ProfileController::class, 'store'])->name('review.store');




    // Route pour la page de confirmation de succès
    Route::get('/paiement/success', function () {
        return view('Pages.success'); // Créez une vue 'success.blade.php' pour cette page
    })->name('paiements.success');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour les réservations d'invités (requête POST)
// Routes du tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes d'authentification (générées par Laravel Breeze/Jetstream)
require __DIR__ . '/auth.php';
require __DIR__ . '/admins-auth.php';

// Route de secours (Fallback) pour les URLs non trouvées
Route::fallback(function () {
    if (auth()->guard('admin')->check()) {
        return redirect('/admin/dashboard');
    }
    return redirect('/');
});
