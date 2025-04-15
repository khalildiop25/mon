<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\User;
use App\Models\Tontine;
use App\Models\Participant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CotisationController extends Controller
{
    // Afficher toutes les cotisations d'un utilisateur
    public function index($participantId)
    {
        $participant = Participant::findOrFail($participantId);
        $cotisations = $participant->cotisations()->paginate(10);

        return view('cotisations.index', compact('cotisations', 'participant'));
    }

    public function create()
    {
        $tontines = Tontine::all();
        $participants = Participant::all();

        return view('cotisations.create', compact('tontines', 'participants'));
    }

    public function showIndex($tontineId)
{
    $tontine = Tontine::findOrFail($tontineId);  // Récupérer la tontine

    // Récupérer les cotisations payées de la tontine et les paginer
    $cotisations = $tontine->cotisations()->where('etat_paiement', 'PAYE')->paginate(10);

    // Calculer la somme totale des cotisations payées
    $totalCotisations = $tontine->cotisations()->where('etat_paiement', 'PAYE')->sum('montant');

    return view('cotisations.showIndex', compact('cotisations', 'tontine', 'totalCotisations'));  // Passer les données à la vue
}

    



public function store(Request $request)
{
    // Validation de base
    $request->validate([
        'idTontine' => 'required|exists:tontines,id',
        'montant' => 'required|numeric|min:1',
        'moyen_paiement' => 'required|in:ESPECES,WAVE,OM',
    ]);

    $user = auth()->user();
    $tontine = Tontine::findOrFail($request->idTontine);

    // 🛑 Vérifie que le montant correspond au montant_de_base de la tontine
    if ($request->montant != $tontine->montant_de_base) {
        return back()->withErrors([
            'montant' => "Le montant saisi doit être exactement de {$tontine->montant_de_base} FCFA pour cette tontine."
        ])->withInput();
    }

    // ✅ Vérification de la fréquence de cotisation
    $lastCotisation = Cotisation::where('idUser', $user->id)
                                ->where('idTontine', $request->idTontine)
                                ->latest()
                                ->first();

    $canCotiser = false;
    $currentDate = now();

    if ($lastCotisation) {
        switch ($tontine->frequence) {
            case 'JOURNALIERE':
                $canCotiser = !$lastCotisation->created_at->isToday();
                break;
            case 'HEBDOMADAIRE':
                $canCotiser = !$lastCotisation->created_at->isSameWeek($currentDate);
                break;
            case 'MENSUEL':
                $canCotiser = !$lastCotisation->created_at->isSameMonth($currentDate);
                break;
        }
    } else {
        $canCotiser = true;
    }

    if (!$canCotiser) {
        return back()->withErrors([
            'message' => 'Vous ne pouvez pas cotiser à nouveau avant la fin de la période spécifiée.'
        ]);
    }

    // ✅ Enregistrement
    Cotisation::create([
        'idUser' => $user->id,
        'idTontine' => $request->idTontine,
        'montant' => $request->montant,
        'moyen_paiement' => $request->moyen_paiement,
        'etat_paiement' => 'EN_ATTENTE',
    ]);

    return redirect()->route('cotisations.Participant', ['participantId' => $user->participant->id])
                     ->with('success', 'Cotisation enregistrée avec succès.');
}


    public function indexG()
    {
        $cotisations = Cotisation::where('etat_paiement', 'EN_ATTENTE')->paginate(10);
        return view('cotisations.indexG', compact('cotisations'));
    }

    public function valider($id)
    {
        $cotisation = Cotisation::find($id);

        if (!$cotisation) {
            return back()->with('error', 'Cotisation non trouvée.');
        }

        if ($cotisation->etat_paiement !== 'EN_ATTENTE') {
            return back()->with('error', 'Cette cotisation ne peut pas être validée.');
        }

        $cotisation->update(['etat_paiement' => 'PAYE']);

        return back()->with('success', 'Cotisation validée avec succès.');
    }

    public function annuler($id)
    {
        $cotisation = Cotisation::find($id);

        if (!$cotisation) {
            return back()->with('error', 'Cotisation non trouvée.');
        }

        if ($cotisation->etat_paiement !== 'EN_ATTENTE') {
            return back()->with('error', 'Cette cotisation ne peut pas être annulée.');
        }

        $cotisation->update(['etat_paiement' => 'ANNULE']);

        return back()->with('success', 'Cotisation annulée avec succès.');
    }
    public function showAllTontines()
{
    $tontines = Tontine::all(); // Récupérer toutes les tontines

    return view('cotisations.tontines', compact('tontines')); // Passer les tontines à la vue
}
public function indexTontines()
{
    // Récupère toutes les tontines (sans filtrer sur les cotisations manquantes)
    $tontines = Tontine::all();

    return view('cotisations.tontines2', compact('tontines'));
}
public function participants($tontineId)
{
    $tontine = Tontine::findOrFail($tontineId);

    // Charge les participants liés à cette tontine via la table pivot
    $participants = $tontine->participants()->with('user')->get();

    return view('cotisations.participants', compact('tontine', 'participants'));
}


public function getDatesManquantes(Request $request, $participantId)
{
    // Récupérer le participant à partir de son ID
    $participant = Participant::findOrFail($participantId);

    // Obtenir l'utilisateur lié à ce participant
    $user = $participant->user;

    // Récupérer la tontine concernée
    $tontine = Tontine::findOrFail($request->tontine_id);

    // Liste des dates manquantes à retourner
    $datesManquantes = [];

    // Début de la tontine
    $startDate = Carbon::parse($tontine->dateDebut);

    // Fin de la tontine (utilise la date actuelle si la dateFin est nulle)
    $tontineEnd = $tontine->dateFin ? Carbon::parse($tontine->dateFin) : now();

    // La date actuelle
    $now = now();

    // Déterminer jusqu'à quand on doit chercher les cotisations
    $endDate = $now->lt($tontineEnd) ? $now : $tontineEnd;

    // Cas pour chaque fréquence
    switch (strtoupper($tontine->frequence)) {
        case 'JOURNALIERE':
            // Boucle jour par jour
            for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
                // Vérifie si une cotisation existe ce jour-là
                $exists = Cotisation::where('idUser', $user->id)
                    ->where('idTontine', $tontine->id)
                    ->whereDate('created_at', $date)
                    ->exists();

                if (!$exists) {
                    // Si c'est une date manquante, l'ajoute à la liste
                    $datesManquantes[] = [
                        'label' => $date->format('d/m/Y'),
                        'last' => $date->eq($tontineEnd), // Vérifie si c’est le dernier jour
                    ];
                }
            }
            break;

        case 'HEBDOMADAIRE':
            // Boucle semaine par semaine
            for ($date = $startDate->copy(); $date <= $endDate; $date->addWeek()) {
                $weekStart = $date->copy();
                $weekEnd = $date->copy()->addWeek()->subDay();

                // Vérifie si une cotisation existe durant la semaine
                $exists = Cotisation::where('idUser', $user->id)
                    ->where('idTontine', $tontine->id)
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->exists();

                if (!$exists) {
                    $datesManquantes[] = [
                        'label' => 'Semaine du ' . $weekStart->format('d/m/Y'),
                        'last' => $weekEnd->gte($tontineEnd), // Si cette semaine touche ou dépasse la fin
                    ];
                }
            }
            break;

        case 'MENSUEL':
            // Boucle mois par mois
            for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {
                $exists = Cotisation::where('idUser', $user->id)
                    ->where('idTontine', $tontine->id)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->exists();

                if (!$exists) {
                    $endOfMonth = $date->copy()->endOfMonth();
                    $datesManquantes[] = [
                        'label' => 'Mois de ' . $date->format('F Y'),
                        'last' => $endOfMonth->gte($tontineEnd), // Fin du mois >= fin de la tontine
                    ];
                }
            }
            break;
    }

    // Retourne la liste des dates au format JSON pour l'AJAX
    return response()->json(['datesManquantes' => $datesManquantes]);
}

public function mesTontines()
{
    $participant = Auth::user()->participant;

    // Récupère les tontines liées à ce participant
    $tontines = $participant->tontines;

    return view('cotisations.tontines_cotisation', compact('tontines'));
}

public function cotisationsParTontine($tontineId)
{
    $userId = Auth::id(); // utilisateur connecté
    $tontine = Tontine::findOrFail($tontineId);

    // Récupère les cotisations de l'utilisateur connecté pour cette tontine
    $cotisations = Cotisation::where('idUser', $userId)
        ->where('idTontine', $tontineId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('cotisations.cotisations_par_tontine', compact('tontine', 'cotisations'));
}
public function cotisationsManquantes($tontineId) 
{
    $user = Auth::user();
    $participant = $user->participant;
    $tontine = Tontine::findOrFail($tontineId);

    $datesManquantes = [];

    $startDate = Carbon::parse($tontine->dateDebut);

    // Si une date de fin est définie, on la prend. Sinon, on prend la date actuelle.
    $now = now();
    $endDate = $tontine->dateFin ? Carbon::parse($tontine->dateFin) : $now;

    // Si la date de fin est future, on ne veut pas aller au-delà d'aujourd'hui
    if ($endDate->greaterThan($now)) {
        $endDate = $now;
    }

    switch (strtoupper($tontine->frequence)) {
        case 'JOURNALIERE':
            for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
                $exists = Cotisation::where('idUser', $user->id)
                    ->where('idTontine', $tontineId)
                    ->whereDate('created_at', $date)
                    ->exists();

                if (!$exists) {
                    $datesManquantes[] = $date->format('d/m/Y');
                }
            }
            break;

            case 'HEBDOMADAIRE':
                $tontineEnd = $tontine->dateFin ? Carbon::parse($tontine->dateFin) : now();
                for ($date = $startDate->copy(); $date <= $tontineEnd; $date->addWeek()) {
                    $exists = Cotisation::where('idUser', $user->id)
                        ->where('idTontine', $tontineId)
                        ->whereBetween('created_at', [$date->copy(), $date->copy()->addWeek()->subDay()])
                        ->exists();
            
                    if (!$exists) {
                        $label = 'Semaine du ' . $date->format('d/m/Y');
            
                        // Vérifie si cette semaine est la dernière avant la fin
                        $nextWeek = $date->copy()->addWeek();
                        if ($nextWeek > $tontineEnd) {
                            $label .= ' (dernière semaine avant la fin)';
                        }
            
                        $datesManquantes[] = $label;
                    }
                }
                break;
            

        case 'MENSUEL':
            for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {
                $exists = Cotisation::where('idUser', $user->id)
                    ->where('idTontine', $tontineId)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->exists();

                if (!$exists) {
                    $datesManquantes[] = 'Mois de ' . $date->format('F Y');
                }
            }
            break;
    }

    return view('cotisations.cotisations_manquantes', compact('tontine', 'datesManquantes'));
}




}
