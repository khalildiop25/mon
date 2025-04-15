@extends('app')

@section('content')
<div class="container">
    <h2>Dernier Tirage - Tontine : {{ $tirage->tontine->libelle }}</h2>

    @if($gagnant)
        <div class="alert alert-success">
            <strong>Félicitations à {{ $gagnant->nom }} !</strong> Il/Elle est le gagnant(e) du dernier tirage effectué pour la tontine.
        </div>
    @else
        <div class="alert alert-warning">
            Aucun tirage effectué pour cette tontine.
        </div>
    @endif
</div>
@endsection
