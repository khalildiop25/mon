@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card pour afficher les informations du profil -->
                <div class="card">
                    <div class="card-header">{{ __('Profil Utilisateur') }}</div>

                    <div class="card-body">
                        <!-- Informations de l'utilisateur -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->nom }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prénom') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="prenom" value="{{ Auth::user()->prenom }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Téléphone') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="telephone" value="{{ Auth::user()->telephone }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dateNaissance" class="col-md-4 col-form-label text-md-end">{{ __('Date de Naissance') }}</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="dateNaissance" value="{{ Auth::user()->participant->dateNaissance }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cni" class="col-md-4 col-form-label text-md-end">{{ __('CNI') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cni" value="{{ Auth::user()->participant->cni }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="adresse" class="col-md-4 col-form-label text-md-end">{{ __('Adresse') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="adresse" value="{{ Auth::user()->participant->adresse }}" readonly>
                            </div>
                        </div>

                        <!-- Affichage de la photo de profil -->
                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Photo de Profil') }}</label>
                            <div class="col-md-6">
                                @if(Auth::user()->participant->imageCni)
                                    <img src="{{ asset('storage/' . Auth::user()->participant->imageCni) }}" alt="Photo de profil" class="img-fluid rounded" style="width: 150px;">
                                @else
                                    <p>Pas de photo de profil.</p>
                                @endif
                                <!-- Formulaire pour télécharger une nouvelle photo -->
                                <form action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="photo" class="form-control" required>
                                    <button type="submit" class="btn btn-success mt-3">Télécharger la photo</button>
                                </form>
                            </div>
                        </div>

                        <!-- Ajouter un bouton pour modifier le profil -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('settings',  auth()->user()->participant->id) }}" class="btn btn-primary">
                                    {{ __('Modifier le Profil') }}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
