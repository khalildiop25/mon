<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        return view('about.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'objet' => 'required',
            'message' => 'required',
        ]);

        // Simuler l'enregistrement (ici on peut envoyer un email ou sauvegarder en base)
        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }


}
