@extends('app')

@section('content')

    <div class="container">
        <h1>Tontines de {{ $participant->user->nom }}</h1>
        <p>Voici toutes les tontines auxquelles ce participant est associé.</p>

        {{-- Affichage des tontines auxquelles le participant participe --}}
        <div class="row">
            <div class="col-12">
                @if($tontines->isEmpty())
                    <p>Ce participant ne fait partie d'aucune tontine pour le moment.</p>
                @else@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <h2 class="text-gold mb-3">Tontines de {{ $participant->user->nom }}</h2>
                <p class="text-muted">Voici toutes les tontines auxquelles ce participant est associé.</p>

                <div class="row">
                    <div class="col-12">
                        @if($tontines->isEmpty())
                            <div class="alert alert-warning">
                                Ce participant ne fait partie d'aucune tontine pour le moment.
                            </div>
                        @else
                            <ul class="list-group shadow-sm">
                                @foreach($tontines as $tontine)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong class="text-dark">{{ $tontine->libelle }}</strong>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info btn-sm me-2">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            @if(Auth::check() && Auth::user()->profil == 'GERANT') 
                                                  <form action="{{ route('participants.detachFromTontine', ['participantId' => $participant->id]) }}" method="POST" class="d-inline">
                                                     @csrf
                                                       <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
                                                       <button type="submit" class="btn btn-danger btn-sm">
                                                           <i class="fas fa-user-minus"></i> Retirer
                                                       </button>
                                                </form>
                                             @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <hr class="my-4">
                @if(Auth::check() && Auth::user()->profil == 'PARTICIPANT')
                <div>
                    <h4 class="mb-3 text-gold">Ajouter à une nouvelle tontine</h4>
                    <form action="{{ route('participants.attachToTontine', $participant->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tontine_id" class="form-label">Choisir une tontine</label>
                            <select name="tontine_id" id="tontine_id" class="form-control rounded" required>
                                <option value="">-- Sélectionnez une tontine --</option>
                                @foreach($allTontines as $tontine)
                                    <option value="{{ $tontine->id }}">{{ $tontine->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">
                            <i class="fas fa-plus-circle"></i> Ajouter à la tontine
                        </button>
                    </form>
                </div>
                @endif
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i>Retour
    </a>
        </div>
    </div>

    <style>
        .text-gold {
            color: #DAA520;
        }
        .gap-2 {
            gap: 0.5rem;
        }
    </style>
@endsection

                    <ul class="list-group">
                        @foreach($tontines as $tontine)
                            <li class="list-group-item">
                                <strong>{{ $tontine->libelle }}</strong> 
                                <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info btn-sm">Voir</a>
                                {{-- Bouton pour retirer le participant de la tontine --}}
                                @if(Auth::check() && Auth::user()->profil == 'GERANT') 
    <form action="{{ route('participants.detachFromTontine', ['participantId' => $participant->id]) }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-user-minus"></i> Retirer
        </button>
    </form>
@endif

                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- Formulaire pour ajouter ce participant à une nouvelle tontine --}}
        @if(Auth::check() && Auth::user()->profil == 'PARTICIPANT')
        <div class="mt-4">
            <h3>Ajouter à une nouvelle tontine</h3>
            <form action="{{ route('participants.attachToTontine', $participant->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tontine_id">Choisir une tontine</label>
                    <select name="tontine_id" id="tontine_id" class="form-control" required>
                        <option value="">-- Sélectionnez une tontine --</option>
                        @foreach($allTontines as $tontine)
                            <option value="{{ $tontine->id }}">{{ $tontine->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Ajouter à la tontine</button>
            </form>
        </div>
        @endif
    </div>
@endsection
