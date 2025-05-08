@extends('app')

@section('content')
<div class="container mt-4">

    {{-- Bouton retour --}}
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Retour
    </a>

    <h1 class="mb-4 text-gold">Liste des Tontines</h1>

    @if($tontines->isEmpty())
        <div class="alert alert-info shadow-sm rounded">
            Aucune tontine disponible.
        </div>
    @else
        <div class="list-group shadow-sm rounded">
            @foreach($tontines as $tontine)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold text-dark">
                        <i class="fas fa-users text-gold mr-2"></i> {{ $tontine->libelle }}
                    </div>
                    <a href="{{ route('cotisations.tontine', ['tontineId' => $tontine->id]) }}" class="btn btn-gold text-white">
                        Voir les cotisations
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
