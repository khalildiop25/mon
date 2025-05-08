@extends('app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white text-center">
            <h3 class="mb-0">🎉 Dernier Tirage</h3>
        </div>

        <div class="card-body text-center">
            <h4 class="mb-4">Tontine : <span class="text-uppercase text-primary">{{ $tirage->tontine->libelle }}</span></h4>

            @if($gagnant)
                <div class="alert alert-success font-weight-bold">
                    🏆 Félicitations à <strong>{{ $gagnant->nom }} {{ $gagnant->prenom }}</strong> !<br>
                    Il/Elle est le gagnant(e) du dernier tirage.
                </div>
            @else
                <div class="alert alert-warning">
                    Aucun tirage n’a encore été effectué pour cette tontine.
                </div>
            @endif

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⏪ Retour</a>
        </div>
    </div>
</div>
@endsection
