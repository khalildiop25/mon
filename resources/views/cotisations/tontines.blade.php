@extends('app')

@section('content')
<div class="container">
    <h1>Liste des Tontines</h1>

    <!-- Affichage des tontines -->
    @if($tontines->isEmpty())
        <div class="alert alert-info">
            Aucune tontine disponible.
        </div>
    @else
        <div class="list-group">
            @foreach($tontines as $tontine)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $tontine->libelle }}</span>  <!-- Nom de la tontine -->
                    
                    <!-- Bouton pour voir les cotisations -->
                    <a href="{{ route('cotisations.tontine', ['tontineId' => $tontine->id]) }}" class="btn bg-gold text-white">
                        Voir les cotisations
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
