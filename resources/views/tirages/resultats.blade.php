@extends('app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-uppercase font-weight-bold">📋 Résultats des derniers tirages</h3>
        <a href="{{ route('home') }}" class="btn btn-secondary">
            ⏪ Retour
        </a>
    </div>

    @foreach($tontines as $tontine)
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-dark text-white">
                <strong>{{ $tontine->libelle }}</strong>
            </div>
            <div class="card-body">
                <p><strong>Fréquence :</strong> {{ $tontine->frequence }}</p>

                @php
                    $dernierTirage = $tontine->tirages->sortByDesc('created_at')->first();
                @endphp

                @if($dernierTirage)
                    <a href="{{ route('tirages.gagnant', ['tontineId' => $tontine->id]) }}" class="btn btn-outline-success">
                        🎯 Voir le dernier gagnant
                    </a>
                @else
                    <p class="text-muted">⚠️ Aucun tirage encore effectué pour cette tontine.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
