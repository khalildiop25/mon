<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\User;
use App\Models\Tontine;
use App\Models\Participant;
use Illuminate\Http\Request;

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
        $tontine = Tontine::find($tontineId);
        $cotisations = $tontine->cotisations;

        return view('cotisations.index', compact('cotisations', 'tontine'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'idTontine' => 'required|exists:tontines,id',
            'montant' => 'required|numeric|min:1',
            'moyen_paiement' => 'required|in:ESPECES,WAVE,OM',
        ]);

        $user = auth()->user();
        $tontine = Tontine::findOrFail($request->idTontine);

        // Vérification de la fréquence de cotisation
        $lastCotisation = Cotisation::where('idUser', $user->id)
                                    ->where('idTontine', $request->idTontine)
                                    ->latest()
                                    ->first();

        $canCotiser = false;
        $currentDate = now();

        if ($lastCotisation) {
            // Vérification de la date de la dernière cotisation en fonction de la fréquence
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
            // Si c'est la première cotisation de l'utilisateur
            $canCotiser = true;
        }

        if (!$canCotiser) {
            return back()->withErrors(['message' => 'Vous ne pouvez pas cotiser à nouveau avant la fin de la période spécifiée.']);
        }

        // Enregistrer la cotisation
        Cotisation::create([
            'idUser' => $user->id,
            'idTontine' => $request->idTontine,
            'montant' => $request->montant,
            'moyen_paiement' => $request->moyen_paiement,
            'etat_paiement' => 'EN_ATTENTE',
        ]);

        return redirect()->route('cotisations.Participant', ['participantId' => $user->participant->id])
                         ->with('success', 'Cotisation enregistrée avec succès');
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
}
