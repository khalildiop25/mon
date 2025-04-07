@extends('app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center display-4">Bienvenue sur Sunu Tontine</h1>

        <!-- Vérification si l'utilisateur est connecté -->
        @if(Auth::check())
            <!-- Vérification du rôle de l'utilisateur -->
            @if(Auth::user()->profil == 'GERANT')
                <!-- Affichage du nom, prénom et imageCni pour le GERANT -->
                <div class="alert alert-success">
                    <div class="row align-items-center">
                        <!-- Image CNI à gauche -->
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . Auth::user()->participant->imageCni) }}" alt="Image CNI" class="img-fluid w-100" style="max-width: 200px; border-radius: 8px;">
                        </div>
                        <!-- Texte à droite -->
                        <div class="col-md-9">
                            <h3 class="display-3">Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }} !</h3>
                            <p class="fs-1">
                                Bienvenue sur votre espace de gestion des tontines. Vous avez accès à toutes les fonctionnalités administratives pour gérer les tontines, les participants et plus encore.
                            </p>
                            <p class="fs-4">
                                Votre rôle de Gérant vous permet de superviser, organiser et gérer l'ensemble des activités liées aux tontines. Assurez-vous que tout fonctionne correctement et que les participants puissent suivre leurs cotisations.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->profil == 'PARTICIPANT')
                <!-- Affichage spécifique au PARTICIPANT -->
                <div class="alert alert-info">
                    <h3 class="display-3">Bienvenue, Participant !</h3>
                    <p class="fs-1">Bienvenue dans votre espace participant. Vous pouvez consulter vos tontines en cours, suivre vos cotisations et plus encore.</p>
                </div>
                <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/accueil.jpg') }}" alt="Image d'accueil" class="img-fluid w-100">
                </div>
                <div class="col-md-6">
                    <p class="fs-3">
                        Bienvenue sur Sunu Tontine, la plateforme où vous pouvez gérer vos tontines en toute sécurité et transparence. Découvrez comment nous facilitons la gestion des cotisations, des prêts, et plus encore à travers notre interface intuitive.
                    </p>
                </div>
            </div>
        

            <!-- Section pour les liens des tontines -->
            <div class="mt-5">
                <h2 class="text-center display-3">Toutes nos Tontines</h2>
                
                @if($tontines->isEmpty())
                    <p class="text-center fs-3">Aucune tontine n'est disponible pour l'instant.</p>
                @else
                    <div class="row">
                        @foreach($tontines as $index => $tontine)
                            @if($index % 3 == 0 && $index != 0)
                                </div>
                                <div class="row">
                            @endif
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-primary w-100">
                                    Tontine: {{ $tontine->libelle }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @endif
        @else
            <!-- Affichage pour un utilisateur non connecté (traité comme un PARTICIPANT) -->
            <div class="alert alert-info">
                <h3 class="display-3">Bienvenue, Participant !</h3>
                <p class="fs-1">Bienvenue dans votre espace participant. Vous pouvez consulter les tontines disponibles et plus encore.</p>
            </div>
        
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/accueil.jpg') }}" alt="Image d'accueil" class="img-fluid w-100">
                </div>
                <div class="col-md-6">
                    <p class="fs-3">
                        Bienvenue sur Sunu Tontine, la plateforme où vous pouvez gérer vos tontines en toute sécurité et transparence. Découvrez comment nous facilitons la gestion des cotisations, des prêts, et plus encore à travers notre interface intuitive.
                    </p>
                </div>
            </div>
        

            <!-- Section pour les liens des tontines -->
            <div class="mt-5">
                <h2 class="text-center display-3">Toutes nos Tontines</h2>
                
                @if($tontines->isEmpty())
                    <p class="text-center fs-3">Aucune tontine n'est disponible pour l'instant.</p>
                @else
                    <div class="row">
                        @foreach($tontines as $index => $tontine)
                            @if($index % 3 == 0 && $index != 0)
                                </div>
                                <div class="row">
                            @endif
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-primary w-100">
                                    Tontine: {{ $tontine->libelle }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection
