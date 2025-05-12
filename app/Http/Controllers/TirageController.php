<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\Participant;
use App\Models\Tirage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TirageController extends Controller
{
    public function form()
    {
        $tontines = Tontine::all();
        return view('tirages.form', compact('tontines'));
    }

    public function tirer(Request $request)
    {
        $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
        ]);

        $tontineId = $request->tontine_id;

        // On récupère les participants de la tontine
        $participants = Participant::whereHas('tontines', function ($q) use ($tontineId) {
            $q->where('tontine_id', $tontineId);
        })->get();

        if ($participants->isEmpty()) {
            return back()->with('error', 'Aucun participant dans cette tontine.');
        }

        // Tirer un participant au hasard
        $gagnant = $participants->random();

        // Vérifie s’il a déjà gagné (optionnel)
        $dejaTire = Tirage::where('idUser', $gagnant->idUser)
                          ->where('idTontine', $tontineId)
                          ->exists();

        if ($dejaTire) {
            return back()->with('error', 'Ce participant a déjà été tiré pour cette tontine.');
        }

        // Enregistrer le tirage
        Tirage::create([
            'idUser' => $gagnant->idUser,
            'idTontine' => $tontineId,
        ]);

        return back()->with('success', 'Le participant tiré est : ' . $gagnant->user->nom . ' ' . $gagnant->user->prenom);
    }
    public function participerForm()
{
    $user = Auth::user();

    if (!$user || !$user->participant) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
    }

    $participant = $user->participant;

    // Récupère les tontines auxquelles il participe
    $tontines = $participant->tontines;

    return view('tirages.participer', compact('tontines'));
}

public function store(Request $request)
{
    $request->validate([
        'tontine_id' => 'required|exists:tontines,id',
    ]);

    $user = Auth::user();
    $tontineId = $request->input('tontine_id');

    // Vérifie si l'utilisateur a déjà gagné dans cette tontine
    $hasAlreadyWon = Tirage::where('idTontine', $tontineId)
        ->where('idUser', $user->id)
        ->exists();

    if ($hasAlreadyWon) {
        return back()->with('error', 'Vous avez déjà gagné un tirage dans cette tontine.');
    }

    // Vérifie s'il a déjà participé au tirage aujourd'hui
    $alreadyParticipatedToday = Tirage::where('idTontine', $tontineId)
        ->where('idUser', $user->id)
        ->whereDate('created_at', today())
        ->exists();

    if ($alreadyParticipatedToday) {
        return back()->with('error', 'Vous avez déjà participé au tirage aujourd\'hui.');
    }

    // Enregistre la participation au tirage
    Tirage::create([
        'idUser' => $user->id,
        'idTontine' => $tontineId,
    ]);

    return back()->with('success', 'Vous avez bien participé au tirage. Le résultat du tirage sera donné à 15h.');
}

public function showLastWinner($tontineId)
{
    // Récupérer le dernier tirage pour la tontine donnée
    $tirage = Tirage::where('idTontine', $tontineId)
                    ->latest() // Trier par date décroissante pour obtenir le plus récent
                    ->first();

    // Si le tirage existe
    if ($tirage) {
        $gagnant = $tirage->user; // Accéder à l'utilisateur (le gagnant) via la relation "user"
        return view('tirages.gagnant', compact('gagnant', 'tirage'));
    }

    // Si aucun tirage n'a été effectué
    return back()->with('error', 'Aucun tirage effectué pour cette tontine.');
}

public function index()
{
    $notifications = Auth::user()->unreadNotifications; // Récupérer les notifications non lues
    return view('dashboard', compact('notifications'));
}

public function resultats()
{
    $tontines = Tontine::with('tirages')->get();

    return view('tirages.resultats', compact('tontines'));
}


}
