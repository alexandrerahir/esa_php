<?php

use Illuminate\Support\Facades\Route;

// Importation des contrôleurs
use App\Http\Controllers\Auth\ConnexionController;
use App\Http\Controllers\Seance\SeanceController;
use App\Http\Controllers\Cheval\ChevalController;
use App\Http\Controllers\Facture\FactureController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Homepage\HomepageController;


// Route de la page d'accueil
Route::get('/', [HomepageController::class, 'index'])->name('homepage')->middleware('authenticate');


// Routes de connexion et déconnexion
Route::get('/connexion', [ConnexionController::class, 'vueConnexion'])->name('auth.connexion')->middleware('guest');
Route::post('/connexion', [ConnexionController::class, 'connexion'])->middleware('guest');
Route::post('/deconnexion', [ConnexionController::class, 'deconnexion'])->name('auth.deconnexion')->middleware('authenticate');


// Routes de gestion des séances
Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index')->middleware('authenticate');

Route::get('/seances/ajouter', [SeanceController::class, 'vueAjouter'])->name('seances.ajouter')->middleware('authenticate');
Route::post('/seances/ajouter', [SeanceController::class, 'ajouter'])->name('seances.ajouter')->middleware('authenticate');

Route::get('/seances/{id}', [SeanceController::class, 'consulter'])->name('seances.consulter')->middleware('authenticate');

Route::get('/seances/{id}/modifier', [SeanceController::class, 'vueModifier'])->name('seances.modifier')->middleware('authenticate');
Route::post('/seances/{id}/modifier', [SeanceController::class, 'modifier'])->middleware('authenticate');

Route::delete('/seances/{id}', [SeanceController::class, 'supprimer'])->name('seances.supprimer')->middleware('authenticate');


// Routes de gestions des chevaux
Route::get('/chevaux', [ChevalController::class, 'index'])->name('chevaux.index')->middleware('authenticate');

Route::get('/chevaux/ajouter', [ChevalController::class, 'vueAjouter'])->name('chevaux.ajouter')->middleware('authenticate');
Route::post('/chevaux/ajouter', [ChevalController::class, 'ajouter'])->name('chevaux.ajouter')->middleware('authenticate');

Route::get('/chevaux/{id}/modifier', [ChevalController::class, 'vueModifier'])->name('chevaux.modifier')->middleware('authenticate');
Route::post('/chevaux/{id}/modifier', [ChevalController::class, 'modifier'])->middleware('authenticate');

Route::delete('/chevaux/{id}', [ChevalController::class, 'supprimer'])->name('chevaux.supprimer')->middleware('authenticate');


// Routes de gestion des clients
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index')->middleware('authenticate');

Route::get('/clients/ajouter', [ClientController::class, 'vueAjouter'])->name('clients.ajouter')->middleware('authenticate');
Route::post('/clients/ajouter', [ClientController::class, 'ajouter'])->name('clients.ajouter')->middleware('authenticate');

Route::get('/clients/{id}/modifier', [ClientController::class, 'vueModifier'])->name('clients.modifier')->middleware('authenticate');
Route::post('/clients/{id}/modifier', [ClientController::class, 'modifier'])->middleware('authenticate');

Route::delete('/clients/{id}', [ClientController::class, 'supprimer'])->name('clients.supprimer')->middleware('authenticate');


// Routes de gestion des factures
Route::get('/factures', [FactureController::class, 'index'])->name('factures.index')->middleware('authenticate');