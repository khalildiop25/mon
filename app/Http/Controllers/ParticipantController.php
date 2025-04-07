<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Tontine;

class ParticipantController extends Controller
{
    public function showTontines($id)
{
    // Trouver le participant
    $participant = Participant::findOrFail($id);

    // Récupérer les tontines auxquelles le participant participe
    $tontines = $participant->tontines; // Cela suppose que la relation "tontines" est définie dans ton modèle Participant
    $allTontines = Tontine::all();  // Pour récupérer toutes les tontines disponibles
    // Passer les tontines à la vue
    return view('participants.tontines', compact('tontines', 'participant', 'allTontines'));
}
    public function index()
    {
        // Récupérer tous les participants
        $participants = Participant::all();
        
        // Passer les participants à la vue
        return view('participants.index', compact('participants'));
    }

    /**
     * Afficher le formulaire d'ajout d'un nouveau participant
     *
     * @return \Illuminate\View\View
     */
    public function create()
{
    // Récupérer tous les utilisateurs
    $user = User::all(); 

    // Afficher la vue avec la liste des utilisateurs
    return view('participants.create', compact('user')); // Ici, on passe la variable $users à la vue
}


    /**
     * Enregistrer un nouveau participant
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    // Valider les données du formulaire
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'telephone' => 'required|string|max:20', // Validation du téléphone
        'dateNaissance' => 'required|date',
        'cni' => 'required|string|unique:participants,cni',
        'adresse' => 'required|string',
        'imageCni' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Créer l'utilisateur
    $user = User::create([
        'nom' => $validated['nom'],
         'prenom' => $request->prenom,  // Assurez-vous de récupérer cette donnée depuis la demande (formulaire).
        'email' => $validated['email'],
        'password' => bcrypt('defaultpassword'), // ou générer un mot de passe temporaire
        'telephone' => $validated['telephone'],  // Ajouter le téléphone
    ]);

    // Télécharger l'image de profil
    $path = $request->file('imageCni')->store('photos', 'public');

    // Créer un participant lié à l'utilisateur
    Participant::create([
        'idUser' => $user->id,
        'dateNaissance' => $validated['dateNaissance'],
        'cni' => $validated['cni'],
        'adresse' => $validated['adresse'],
        'imageCni' => $path,  // Enregistrer le chemin de l'image
    ]);

    // Rediriger avec succès
    return redirect()->route('participants.index')->with('success', 'Participant ajouté avec succès.');
}




    /**
     * Afficher le détail d'un participant
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        // Ici, tu pourrais récupérer les informations de l'utilisateur connecté
        // et les passer à la vue
        return view('participants.profile');
    }

    // Afficher la page des paramètres
    public function settings()
    {
        return view('participants.settings');}
    public function show($id)
    {
        // Trouver le participant par ID
        $participant = Participant::findOrFail($id);

        // Afficher la vue avec les détails du participant
        return view('participants.show', compact('participant'));
    }

    /**
     * Afficher le formulaire pour éditer un participant
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Trouver le participant par ID
        $participant = Participant::findOrFail($id);

        // Afficher la vue avec le formulaire d'édition
        return view('participants.edit', compact('participant'));
    }

    /**
     * Mettre à jour les informations d'un participant
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    
    // Validation des données du formulaire
    $request->validate([
        'dateNaissance' => 'required|date',
        'cni' => 'required|min:13|max:13|unique:participants,cni,' . $id,
        'adresse' => 'required|string',
        'imageCni' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Si une image est ajoutée
        'profil' => 'nullable|in:PARTICIPANT,GERANT', // Validation pour le champ profil
    ]);

    // Trouver le participant par ID
    $participant = Participant::findOrFail($id);
    $participant->dateNaissance = $request->dateNaissance;
    $participant->cni = $request->cni;
    $participant->adresse = $request->adresse;

    // Si une nouvelle image de la CNI est téléchargée, on la stocke
    if ($request->hasFile('imageCni')) {
        $path = $request->file('imageCni')->store('public/cni_images');
        $participant->imageCni = basename($path);
    }

    // Si un nouveau profil est sélectionné (et que c'est un administrateur qui fait cela)
    if ($request->has('profil') && auth()->user()->profil == 'GERANT') {
        $participant->user->profil = $request->profil;
        $participant->user->save();
    }

    // Sauvegarder les changements
    $participant->save();

    // Redirection après succès
    return redirect()->route('participants.index')->with('success', 'Participant mis à jour avec succès');
}


    /**
     * Supprimer un participant
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Trouver le participant par ID
        $participant = Participant::findOrFail($id);

        // Supprimer le participant
        $participant->delete();

        // Redirection après succès
        return redirect()->route('participants.index')->with('success', 'Participant supprimé avec succès');
    }
    public function set(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'prenom' => 'required|string|max:255',  // Validation pour le prénom
        'nom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
        'telephone' => 'required|string|max:15',
        'dateNaissance' => 'required|date',
        'cni' => 'required|string|max:13',
        'adresse' => 'required|string|max:255',
        'password' => 'nullable|confirmed|min:6', // Si un nouveau mot de passe est fourni
    ]);

    // Debug pour vérifier si la validation échoue
    // dd($request->all()); // Supprime cette ligne après vérification

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Mise à jour des données de l'utilisateur
    $user->prenom = $request->prenom;  // Mise à jour du prénom
    $user->nom = $request->nom;
    $user->email = $request->email;
    $user->telephone = $request->telephone;

    // Si un mot de passe est fourni, on le met à jour
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Sauvegarder les informations de l'utilisateur
    $user->save();

    // Mise à jour des informations du participant associé
    $participant = $user->participant;
    $participant->dateNaissance = $request->dateNaissance;
    $participant->cni = $request->cni;
    $participant->adresse = $request->adresse;

    // Sauvegarder les informations du participant
    $participant->save();

    // Redirection avec un message de succès
    return redirect()->route('set')->with('success', 'Profil mis à jour avec succès');
}


}