@extends('app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary">
        <i class="fas fa-calendar-times mr-2"></i>Cotisations manquantes - {{ $tontine->libelle }}
    </h2>

    <a href="{{ url()->previous(), $tontine->id }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left mr-1"></i>Retour aux cotisations
    </a>

    {{-- MESSAGES DE SESSION --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-exclamation-triangle mr-2"></i>Erreurs :</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-warning">
            <i class="fas fa-info-circle mr-2"></i>{{ session('message') }}
        </div>
    @endif

    {{-- LISTE DES COTISATIONS MANQUANTES --}}
    @if(empty($datesManquantes))
        <div class="alert alert-success">
            <i class="fas fa-thumbs-up mr-2"></i>Félicitations ! Vous êtes à jour dans vos cotisations.
        </div>
    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-circle mr-2"></i>Vous avez {{ count($datesManquantes) }} cotisation(s) manquante(s).
        </div>

        <ul class="list-group">
            @foreach($datesManquantes as $index => $item)
                @php
                    $label = $item['label'];
                    $date_retarde = $item['date'];
                    $cotisation = \App\Models\Cotisation::where('idUser', auth()->id())
                        ->where('idTontine', $tontine->id)
                        ->whereDate('date_retarde', $date_retarde)
                        ->first();
                @endphp

                @if (!$cotisation || $cotisation->etat_paiement == 'EN_ATTENTE')
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-calendar-alt mr-2 text-muted"></i>{{ $label }}</span>
                            <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#form-{{ $index }}">
                                <i class="fas fa-plus-circle mr-1"></i>Cotiser maintenant
                            </button>
                        </div>

                        <div id="form-{{ $index }}" class="collapse mt-3">
                            <form action="{{ route('cotisations.storeManquante') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
                                <input type="hidden" name="date_retarde" value="{{ $date_retarde }}">

                                <div class="form-group">
                                    <label for="montant">Montant</label>
                                    <input type="number" name="montant" class="form-control" placeholder="Ex : 1000" required>
                                </div>

                                <div class="form-group">
                                    <label for="moyen_paiement">Moyen de paiement</label>
                                    <select name="moyen_paiement" class="form-control" required>
                                        <option value="">-- Choisir --</option>
                                        <option value="ESPECES">ESPECES</option>
                                        <option value="WAVE">WAVE</option>
                                        <option value="OM">OM</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="fas fa-check mr-1"></i>Valider la cotisation
                                </button>
                            </form>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</div>
@endsection
