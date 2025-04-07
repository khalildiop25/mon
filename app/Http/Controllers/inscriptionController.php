<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    //Permet d'accéder à la vue inscription
    public function index()
    {
        return view('page.incription.index');
    }

    //Valider le formulaire
    public function register(Request $request)
    {
        $request->validate([
            'prenom' => 'required|min:3',
            'nom' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|max:9|unique:users',
            'dateNaissance' => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
            'cni' => 'required|min:13|max:13',
            'adresse' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ]);

        //Enregistrement dans la base de données
        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
         // Vérification si le CNI existe déjà dans la table participants
    $existingParticipant = Participant::where('cni', $request->cni)->first();

    if ($existingParticipant) {
        return back()->with('error', 'Le CNI existe déjà. Veuillez entrer un autre numéro.');
    }

        //Enregistrement du participant si la création du User est bon
        if ($user) {
            $participant = new Participant();
            $participant->idUser = $user->id;
            $participant->dateNaissance = $request->dateNaissance;
            $participant->cni = $request->cni;
            $participant->adresse = $request->adresse;
            $participant->save();

            //Authentification
            $request->session()->regenerate();

             // Authentifier l'utilisateur après l'inscription
        Auth::login($user);

            //Redirection vers la page d'accueil
            return redirect()->route('home');
        }

        return back()->with('error', "Une erreur s'est produite");
    }

    public function home() {
        $tontines = Tontine::all();
        return view('welcome', compact('tontines'));
    }
}
