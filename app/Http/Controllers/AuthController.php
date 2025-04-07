<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create() {
        return view('page2.auth.auth');
    }
    // Méthode de déconnexion
    public function logout(Request $request) {
        // Déconnecter l'utilisateur
        Auth::logout();

        // Regénérer la session pour des raisons de sécurité
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil ou une autre page après la déconnexion
        return redirect()->route('home');
    }

    public function auth(Request $request) {
        $auth = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($auth)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->with('error', "Email et/ou Mot de passe incorrect");
    }
}