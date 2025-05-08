@extends('app')

@section('content')
<div class="container">
    <h1>Toutes les Tontines</h1>

    @if($tontines->isEmpty())
        <div class="alert alert-info">
            Aucune tontine disponible.
        </div>
    @else
        <ul class="list-group">
            @foreach($tontines as $tontine)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $tontine->libelle }}</span>
                    <a href="{{ route('cotisations.tontine.participants', $tontine->id) }}" class="btn bg-gold text-white">
                        Voir les participants
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
<!-- Lien de retour -->
<a href="{{ route('home') }}" class="btn btn-secondary mt-4">Retour</a>
@endsection
