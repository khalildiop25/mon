@extends('app')

@section('content')
<div class="container">
    <h1>Modifier les informations du Participant</h1>

    <!-- Message de succès s'il y en a -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Vérification du rôle de l'utilisateur -->
    @if(!auth()->check() || auth()->user()->profil != 'GERANT')
        <!-- Si l'utilisateur n'est pas authentifié ou n'est pas un gérant -->
        <div class="alert alert-danger">
            Modification non autorisée. Vous devez être un gérant pour effectuer cette action.
        </div>
        <a href="{{ route('participants.index') }}" class="btn btn-secondary mt-3">Retour à la liste des participants</a>
    @else
        <!-- Si l'utilisateur est un gérant, afficher le formulaire -->
        <form action="{{ route('participants.update', $participant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nom d'utilisateur (en lecture seule) -->
            <div class="form-group">
                <label for="idUser">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="idUser" value="{{ $participant->user->nom }}" disabled>
            </div>

            <!-- Date de naissance -->
            <div class="form-group">
                <label for="dateNaissance">Date de naissance</label>
                <input type="date" class="form-control @error('dateNaissance') is-invalid @enderror" id="dateNaissance" name="dateNaissance" value="{{ old('dateNaissance', $participant->dateNaissance) }}" required>
                @error('dateNaissance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Numéro de CNI -->
            <div class="form-group">
                <label for="cni">Numéro de CNI</label>
                <input type="text" class="form-control @error('cni') is-invalid @enderror" id="cni" name="cni" value="{{ old('cni', $participant->cni) }}" required>
                @error('cni')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Adresse -->
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <textarea class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" rows="3" required>{{ old('adresse', $participant->adresse) }}</textarea>
                @error('adresse')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image de la CNI (facultatif) -->
            <div class="form-group">
                <label for="imageCni">Image de la CNI (facultatif)</label>
                <input type="file" class="form-control-file @error('imageCni') is-invalid @enderror" id="imageCni" name="imageCni" accept="image/*">
                @if($participant->imageCni)
                    <div class="mt-2">
                        <img src="{{ asset('storage/cni_images/' . $participant->imageCni) }}" alt="Image de la CNI" width="100">
                    </div>
                @endif
                @error('imageCni')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rôle (participant/gerant) -->
            @if(auth()->user()->profil == 'GERANT') <!-- Permet uniquement à l'administrateur de modifier le rôle -->
            <div class="form-group">
                <label for="profil">Rôle</label>
                <select class="form-select @error('profil') is-invalid @enderror" id="profil" name="profil" required>
                    <!-- La valeur 'PARTICIPANT' correspond à la valeur attendue dans la base de données -->
                    <option value="PARTICIPANT" {{ old('profil', $participant->user->profil) == 'PARTICIPANT' ? 'selected' : '' }}>Participant</option>
                    
                    <!-- La valeur 'GERANT' correspond à la valeur attendue dans la base de données -->
                    <option value="GERANT" {{ old('profil', $participant->user->profil) == 'GERANT' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('profil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-secondary">Retour</a>
        </form>
    @endif
</div>
@endsection
