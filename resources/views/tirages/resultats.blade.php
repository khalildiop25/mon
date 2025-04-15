@extends('app')

@section('content')
<div class="container">
    <h2>Résultats des derniers tirages</h2>

    @foreach($tontines as $tontine)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $tontine->libelle }}</strong>
            </div>
            <div class="card-body">
                <p>Fréquence : {{ $tontine->frequence }}</p>

                @php
                    $dernierTirage = $tontine->tirages->sortByDesc('created_at')->first();
                @endphp

                @if($dernierTirage)
                    <a href="{{ route('tirages.gagnant', ['tontineId' => $tontine->id]) }}" class="btn btn-info">
                        Voir le dernier gagnant
                    </a>
                @else
                    <p class="text-muted">Aucun tirage encore effectué pour cette tontine.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
