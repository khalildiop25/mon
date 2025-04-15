@extends('app')

@section('content')
<div class="container">
    <h2>Mes Tontines</h2>

    @if($tontines->isEmpty())
        <div class="alert alert-info">Vous ne participez à aucune tontine.</div>
    @else
        <ul class="list-group">
            @foreach($tontines as $tontine)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $tontine->libelle }}
                    <a href="{{ route('cotisations.user.tontine', $tontine->id) }}" class="btn bg-gold text-white">Voir mes cotisations</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
