@extends('app')

@section('content')
    <div class="container">
        <h1>Tontines de {{ $participant->user->name }}</h1>
        <p>Voici toutes les tontines auxquelles ce participant est associé.</p>

        {{-- Affichage des tontines auxquelles le participant participe --}}
        <div class="row">
            <div class="col-12">
                @if($tontines->isEmpty())
                    <p>Ce participant ne fait partie d'aucune tontine pour le moment.</p>
                @else
                    <ul class="list-group">
                        @foreach($tontines as $tontine)
                            <li class="list-group-item">
                                <strong>{{ $tontine->nom }}</strong> 
                                <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info btn-sm">Voir</a>
                                {{-- Bouton pour retirer le participant de la tontine --}}
                                <form action="{{ route('participants.detachFromTontine', ['participantId' => $participant->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Retirer de la tontine</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- Formulaire pour ajouter ce participant à une nouvelle tontine --}}
        <div class="mt-4">
            <h3>Ajouter à une nouvelle tontine</h3>
            <form action="{{ route('participants.attachToTontine', $participant->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tontine_id">Choisir une tontine</label>
                    <select name="tontine_id" id="tontine_id" class="form-control" required>
                        <option value="">-- Sélectionnez une tontine --</option>
                        @foreach($allTontines as $tontine)
                            <option value="{{ $tontine->id }}">{{ $tontine->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Ajouter à la tontine</button>
            </form>
        </div>
    </div>
@endsection
