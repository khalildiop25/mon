@extends('app')

@section('content')
<div class="container mt-5"> 
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg rounded border-0">
                <div class="card-header bg-gold text-white">
                    <h4 class="mb-0 text-center">Ajouter un Participant</h4>
                </div>

                <div class="card-body px-5 py-4">
                  <div class="alert alert-info">
                      <strong>Note :</strong> Ce participant pourra se connecter avec un mot de passe par défaut composé de 4 zéros : <code>0000</code>. Il pourra le modifier après la connexion.
                  </div>

                    <form method="POST" action="{{ route('admin.participants.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom -->
                        <div class="form-group mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" required>
                        </div>

                        <!-- Prénom -->
                        <div class="form-group mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <!-- Téléphone -->
                        <div class="form-group mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" id="telephone" name="telephone" class="form-control" required>
                        </div>

                        <!-- Date de Naissance -->
                        <div class="form-group mb-3">
                            <label for="dateNaissance" class="form-label">Date de Naissance</label>
                            <input type="date" id="dateNaissance" name="dateNaissance" class="form-control" required>
                        </div>

                        <!-- CNI -->
                        <div class="form-group mb-3">
                            <label for="cni" class="form-label">Numéro de CNI</label>
                            <input type="text" id="cni" name="cni" class="form-control" required>
                        </div>

                        <!-- Adresse -->
                        <div class="form-group mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" required>
                        </div>

                        <!-- Photo de Profil -->
                        <div class="form-group mb-4">
                            <label for="imageCni" class="form-label">Image de la CNI</label>
                            <input type="file" id="imageCni" name="imageCni" class="form-control-file" required>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
                            <button type="submit" class="btn btn-gold">Ajouter le Participant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
