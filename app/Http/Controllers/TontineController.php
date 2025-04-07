<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TontineController extends Controller
{
    public function participer($id)
{
    // Vérifier si l'utilisateur est authentifié
    if (!auth()->check()) {
        return redirect()->route('auth.store')->with('error', 'Vous devez être connecté pour participer à une tontine.');
    }

    // Récupérer la tontine avec l'ID donné
    $tontine = Tontine::findOrFail($id);
    
    // Récupérer l'utilisateur authentifié
    $participant = auth()->user();

    // Vérifier si la date de début est déjà passée
    if ($tontine->dateDebut < now()) {
        return redirect()->back()->with('error', 'La tontine a déjà commencé.');
    }

    // Vérifier si la date de fin est déjà passée
    if ($tontine->dateFin < now()) {
        return redirect()->back()->with('error', 'Cette tontine est terminée.');
    }

    // Vérifier si le nombre de participants a été atteint
    $currentParticipants = $tontine->participants()->count();  // Compte le nombre de participants actuels
    if ($currentParticipants >= $tontine->nbreParticipant) {
        // Si le nombre de participants atteint la limite, afficher un message d'erreur
        return redirect()->back()->with('error', 'Le nombre maximum de participants a été atteint.');
    }

    // Vérifier si l'utilisateur est déjà inscrit à cette tontine
    if ($tontine->participants()->where('participant_id', $participant->id)->exists()) {
        // Si l'utilisateur est déjà inscrit à la tontine, afficher un message d'erreur
        return redirect()->back()->with('error', 'Vous participez déjà à cette tontine.');
    }

    // Sinon, ajouter l'utilisateur à la tontine
    $tontine->participants()->attach($participant);

    // Rediriger vers la page de la tontine avec un message de succès
    return redirect()->route('tontines.show', $tontine->id)->with('success', 'Vous avez bien rejoint la tontine.');
}


public function participants($id)
{
    // Récupérer la tontine avec les participants
    $tontine = Tontine::with('participants')->findOrFail($id);

    // Passer la tontine et ses participants à la vue
    return view('tontines.participants', compact('tontine'));
}





    // Afficher la liste des tontines
    public function index()
    {
        $tontines = Tontine::paginate(10); // Récupère 10 tontines par page

        // Convertir les dates en objets Carbon pour un meilleur formatage dans la vue
        $tontines->each(function ($tontine) {
            $tontine->dateDebut = Carbon::parse($tontine->dateDebut);
            $tontine->dateFin = Carbon::parse($tontine->dateFin);
        });

        return view('tontines.index', compact('tontines')); // Retourne la vue avec les tontines paginées
    }

    // Afficher le formulaire pour créer une nouvelle tontine
    public function create()
    {
        return view('tontines.create');
    }

    // Sauvegarder une nouvelle tontine dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'frequence' => 'required|string',
            'libelle' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'description' => 'nullable|string',
            'montant_total' => 'required|numeric',
            'montant_de_base' => 'required|numeric',
            'nbreParticipant' => 'required|integer',
        ]);

        // Créer la tontine et assurer que les dates sont correctement converties
        $tontineData = $request->all();
        $tontineData['dateDebut'] = Carbon::parse($request->dateDebut);
        $tontineData['dateFin'] = Carbon::parse($request->dateFin);

        Tontine::create($tontineData);

        return redirect()->route('tontines.index')->with('success', 'Tontine créée avec succès.');
    }

    // Afficher une tontine spécifique
    public function show($id)
    {
        $tontine = Tontine::findOrFail($id); // Récupère la tontine par ID
        // Assurez-vous que les dates sont des objets Carbon pour les afficher correctement
        $tontine->dateDebut = Carbon::parse($tontine->dateDebut);
        $tontine->dateFin = Carbon::parse($tontine->dateFin);

        return view('tontines.show', compact('tontine')); // Retourne la vue avec la tontine spécifique
    }

    // Afficher le formulaire pour éditer une tontine
    public function edit($id)
    {
        $tontine = Tontine::findOrFail($id);  // Recherche la tontine par ID
        // Assurez-vous que les dates sont des objets Carbon pour les afficher correctement
        $tontine->dateDebut = Carbon::parse($tontine->dateDebut);
        $tontine->dateFin = Carbon::parse($tontine->dateFin);

        return view('tontines.edit', compact('tontine'));  // Retourne la vue avec la tontine à éditer
    }

    // Mettre à jour une tontine dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'frequence' => 'required|string',
            'libelle' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
            'montant_total' => 'required|numeric',
            'montant_de_base' => 'required|numeric',
            'nbreParticipant' => 'required|integer',
        ]);

        $tontine = Tontine::findOrFail($id);  // Recherche la tontine par ID

        // Mettre à jour les dates en objets Carbon
        $tontine->dateDebut = Carbon::parse($request->dateDebut);
        $tontine->dateFin = Carbon::parse($request->dateFin);

        $tontine->update($request->all());  // Met à jour la tontine avec les nouvelles données

        return redirect()->route('tontines.index')->with('success', 'Tontine mise à jour avec succès.');
    }

    // Supprimer une tontine
    public function destroy($id)
    {
        $tontine = Tontine::findOrFail($id);  // Recherche la tontine par ID
        $tontine->delete();  // Supprime la tontine

        return redirect()->route('tontines.index')->with('success', 'Tontine supprimée avec succès.');
    }
}
