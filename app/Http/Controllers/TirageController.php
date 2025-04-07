<?php

namespace App\Http\Controllers;

use App\Models\Tirage;
use App\Models\User;
use App\Models\Tontine;
use Illuminate\Http\Request;

class TirageController extends Controller
{
    // Afficher tous les tirages d'un utilisateur
    public function showUser($userId)
    {
        $user = User::find($userId);
        $tirages = $user->tirages; // Utilisation de la relation définie dans le modèle User

        return view('tirages.index', compact('tirages', 'user'));
    }

    // Afficher tous les tirages d'une tontine
    public function showTontineTirages($tontineId)
    {
        $tontine = Tontine::find($tontineId);
        $tirages = $tontine->tirages; // Utilisation de la relation définie dans le modèle Tontine

        return view('tirages.index', compact('tirages', 'tontine'));
    }
    public function create()
   {
    $users = User::all(); // Récupérer tous les utilisateurs
    $tontines = Tontine::all(); // Récupérer toutes les tontines

    return view('tirages.create', compact('users', 'tontines'));
   }


    // Enregistrer un tirage
    public function store(Request $request)
    {
        $request->validate([
            'idUser' => 'required|exists:users,id',
            'idTontine' => 'required|exists:tontines,id',
        ]);

        // Enregistrer le tirage
        Tirage::create([
            'idUser' => $request->idUser,
            'idTontine' => $request->idTontine,
        ]);

        return redirect()->route('tirages.index')->with('success', 'Tirage enregistré avec succès');
    }
}