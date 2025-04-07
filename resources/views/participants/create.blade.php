@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card pour ajouter un nouveau participant -->
                <div class="card">
                    <div class="card-header">{{ __('Ajouter un Participant') }}</div>

                    <div class="card-body">
                        <!-- Formulaire pour ajouter un participant -->
                        <form method="POST" action="{{ route('admin.participants.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Champ Nom (au lieu de name) -->
                            <div class="row mb-3">
                                <label for="nom" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="nom" name="nom" class="form-control" required>
                                </div>
                            </div>

                            <!-- Champ Prénom -->
                            <div class="row mb-3">
                                <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prénom') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="prenom" name="prenom" class="form-control" required>
                                </div>
                            </div>

                            <!-- Champ Email -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <!-- Champ Téléphone -->
<div class="row mb-3">
    <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Téléphone') }}</label>
    <div class="col-md-6">
        <input type="text" id="telephone" name="telephone" class="form-control" required>
    </div>
</div>


                            <!-- Champ Date de naissance -->
                            <div class="row mb-3">
                                <label for="dateNaissance" class="col-md-4 col-form-label text-md-end">{{ __('Date de Naissance') }}</label>
                                <div class="col-md-6">
                                    <input type="date" id="dateNaissance" name="dateNaissance" class="form-control" required>
                                </div>
                            </div>

                            <!-- Champ CNI -->
                            <div class="row mb-3">
                                <label for="cni" class="col-md-4 col-form-label text-md-end">{{ __('CNI') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="cni" name="cni" class="form-control" required>
                                </div>
                            </div>

                            <!-- Champ Adresse -->
                            <div class="row mb-3">
                                <label for="adresse" class="col-md-4 col-form-label text-md-end">{{ __('Adresse') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="adresse" name="adresse" class="form-control" required>
                                </div>
                            </div>

                            <!-- Champ Photo de Profil -->
                            <div class="row mb-3">
                                <label for="imageCni" class="col-md-4 col-form-label text-md-end">{{ __('Photo de Profil') }}</label>
                                <div class="col-md-6">
                                    <input type="file" id="imageCni" name="imageCni" class="form-control" required>
                                </div>
                            </div>

                            <!-- Bouton pour soumettre le formulaire -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Ajouter le Participant') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
