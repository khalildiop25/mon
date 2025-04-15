@extends('app')

@section('content')
<div class="container">
    <h2>Cotisations manquantes - {{ $tontine->libelle }}</h2>

    <a href="{{ route('cotisations.user.tontine', $tontine->id) }}" class="btn btn-secondary mb-3">
        Retour aux cotisations
    </a>

    @if(empty($datesManquantes))
        <div class="alert alert-success">
            Félicitations ! Vous êtes à jour dans vos cotisations.
        </div>
    @else
        <div class="alert alert-warning">
            Vous avez {{ count($datesManquantes) }} cotisation(s) manquante(s).
        </div>
        <ul class="list-group">
            @foreach($datesManquantes as $date)
                <li class="list-group-item">
                    {{ $date }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
