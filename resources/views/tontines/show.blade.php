@extends('app')

@section('content')
<div class="container">
    <h1>Détails de la Tontine</h1>

    <!-- Message de succès s'il y en a -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Message d'erreur s'il y en a -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Affichage des détails de la tontine -->
    <div class="mb-3">
        <a href="{{ route('tontines.index') }}" class="btn btn-secondary">Retour à la liste des tontines</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tontine #{{ $tontine->id }}</h5>
            <p><strong>Libellé :</strong> {{ $tontine->libelle }}</p>
            <p><strong>Fréquence :</strong> {{ $tontine->frequence }}</p>
            <p><strong>Date de début :</strong> {{ $tontine->dateDebut->format('d/m/Y') }}</p>
            <p><strong>Date de fin :</strong> {{ $tontine->dateFin->format('d/m/Y') }}</p>
            <p><strong>Montant total :</strong> {{ number_format($tontine->montant_total, 2, ',', ' ') }} FCFA</p>
            <p><strong>Participants :</strong> {{ $tontine->nbreParticipant }}</p>
            <p><strong>description :</strong> {{ $tontine->description }}</p>
        </div>
    </div>

    <div class="mt-3">
        <!-- Vérification du rôle de l'utilisateur -->
        @if(auth()->check() && auth()->user()->profil == 'GERANT')
            <!-- Affichage des boutons "Modifier" et "Supprimer" si l'utilisateur est un gérant -->
            <a href="{{ route('tontines.edit', $tontine->id) }}" class="btn btn-warning">Modifier</a>

            <!-- Formulaire pour supprimer -->
            <form action="{{ route('tontines.destroy', $tontine->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tontine ?')">Supprimer</button>
            </form>
        @elseif(auth()->check() && auth()->user()->profil == 'PARTICIPANT')
            <!-- Affichage du bouton "Participer" si l'utilisateur est un participant -->
            <a href="{{ route('tontines.participer', $tontine->id) }}" class="btn btn-success">Participer à la Tontine</a>
        @elseif(!auth()->check())
            <!-- Affichage du bouton "Participer" si l'utilisateur n'est pas authentifié -->
            <a href="{{ route('tontines.participer', $tontine->id) }}" class="btn btn-success">Participer à la Tontine</a>
        @endif
    </div>
</div>
@endsection
