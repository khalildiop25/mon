<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TirageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InscriptionController::class, 'home'])->name('home');

//Inscription utilisateur
Route::get('register', [InscriptionController::class, 'index'])->name('inscription.index');
Route::post('validate-register', [InscriptionController::class, 'register'])->name('incription.register');

//Authentification
Route::get('connexion', [AuthController::class, 'create'])->name('auth.create');
Route::post('connexion', [AuthController::class, 'auth'])->name('auth.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//tontine
Route::get('tontines/index', [TontineController::class, 'index'])->name('tontines.index');  // Liste des tontines
Route::get('tontines/create', [TontineController::class, 'create'])->name('tontines.create');  // Formulaire de création
Route::post('tontines', [TontineController::class, 'store'])->name('tontines.store');  // Enregistrement d'une nouvelle tontine
Route::get('tontines/{id}/show', [TontineController::class, 'show'])->name('tontines.show');  // Affichage des détails d'une tontine
Route::get('tontines/{id}/edit', [TontineController::class, 'edit'])->name('tontines.edit');  // Formulaire d'édition d'une tontine
Route::put('tontines/{id}', [TontineController::class, 'update'])->name('tontines.update');  // Mise à jour de la tontine
Route::delete('tontines/{id}', [TontineController::class, 'destroy'])->name('tontines.destroy');  // Suppression d'une tontine
Route::get('tontines/{id}/participer', [TontineController::class, 'participer'])->name('tontines.participer');
Route::get('tontines/{id}/participants', [TontineController::class, 'participants'])->name('tontines.participants'); //route pour afficher les participants d'une tontine




//cotisation
Route::get('/participant/{participantId}/cotisations', [CotisationController::class, 'index'])->name('cotisations.Participant');
Route::get('/cotisations/create', [CotisationController::class, 'create'])->name('cotisations.create');
// Route pour afficher les cotisations d'un utilisateur spécifique
Route::get('cotisations/user/{id}', [CotisationController::class, 'showUserCotisations'])->name('cotisations.user');
/// Affichage des cotisations non payées
Route::get('/cotisations', [CotisationController::class, 'indexG'])->name('cotisations.index');

// Valider une cotisation
Route::patch('/cotisations/valider/{id}', [CotisationController::class, 'valider'])->name('cotisations.valider');

// Annuler une cotisation
Route::patch('/cotisations/annuler/{id}', [CotisationController::class, 'annuler'])->name('cotisations.annuler');


Route::get('/tontine/{tontineId}', [CotisationController::class, 'showIndex'])->name('cotisations.tontine');
Route::post('/cotisations', [CotisationController::class, 'store'])->name('cotisations.store');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');



//participant
// Profil de l'utilisateur
Route::get('participants/profile', [ParticipantController::class, 'showProfile'])->name('profile');
// Paramètres de l'utilisateur
Route::get('/settings', [ParticipantController::class, 'settings'])->name('settings');
// Route pour mettre à jour les informations du profil
Route::put('/settings', [ParticipantController::class, 'set'])->name('set');
Route::get('/index', [ParticipantController::class, 'index'])->name('participants.index');
Route::get('/create', [ParticipantController::class, 'create'])->name('admin.participants.create');
Route::post('/store', [ParticipantController::class, 'store'])->name('admin.participants.store');
Route::get('/{id}', [ParticipantController::class, 'show'])->name('participants.show');
Route::get('/{id}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
Route::put('/{id}', [ParticipantController::class, 'update'])->name('participants.update');
Route::delete('/{id}', [ParticipantController::class, 'destroy'])->name('participants.destroy');
Route::get('participants/{id}/tontines', [ParticipantController::class, 'showTontines'])->name('participant.tontines');
//pour permettre d'ajouter le participant à une nouvelle tontine.
Route::post('/participants/{participantId}/attach', [ParticipantController::class, 'attachToTontine'])->name('participants.attachToTontine');
//pour retirer un participant d'une tontine spécifique.
Route::post('/participants/{participantId}/detach', [ParticipantController::class, 'detachFromTontine'])->name('participants.detachFromTontine');




// image
Route::post('/profile/upload-photo', [ImageController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
Route::get('tontines/{idTontine}/images/create', [ImageController::class, 'create'])->name('images.create');
Route::post('tontines/{idTontine}/images', [ImageController::class, 'store'])->name('images.store');
Route::get('tontines/{idTontine}/images', [ImageController::class, 'index'])->name('images.index');
Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

//tirage
Route::get('/user/{userId}', [TirageController::class, 'showUser'])->name('tirages.user');
Route::get('/tontine/{tontineId}', [TirageController::class, 'showTontineTirages'])->name('tirages.tontine');
Route::get('tirages/create', [TirageController::class, 'create'])->name('tirages.create');
Route::post('/', [TirageController::class, 'store'])->name('tirages.store');

