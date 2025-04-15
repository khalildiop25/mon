@extends('app')

@section('content')
<div class="container">
    <h1>Effectuer une Cotisation</h1>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de cotisation -->
    <form action="{{ route('cotisations.store') }}" method="POST">
        @csrf

        <!-- Champ caché pour l'ID de l'utilisateur connecté -->
        <input type="hidden" name="idUser" value="{{ auth()->id() }}">

        <!-- Sélectionner la tontine -->
        <div class="mb-3">
            <label for="idTontine" class="form-label">Tontine</label>
            <select name="idTontine" id="idTontine" class="form-control" required>
                <option value="" disabled selected>Sélectionner une tontine</option>
                @foreach($tontines as $tontine)
                    <option value="{{ $tontine->id }}" {{ old('idTontine') == $tontine->id ? 'selected' : '' }}>
                        {{ $tontine->libelle }} ({{ $tontine->nbreParticipant }} participants) 
                        @if($tontine->frequence) - {{ $tontine->frequence }} @endif
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Montant de la cotisation -->
        <div class="mb-3">
            <label for="montant" class="form-label">Montant de la cotisation (FCFA)</label>
            <input type="number" name="montant" id="montant" class="form-control" value="{{ old('montant') }}" required min="1">
        </div>

        <!-- Mode de paiement (Wave ou Orange Money) -->
        <div class="mb-3">
            <label for="moyen_paiement" class="form-label">Mode de paiement</label>
            <select name="moyen_paiement" id="moyen_paiement" class="form-control" required>
                <option value="" disabled selected>Sélectionner le mode de paiement</option>
                <option value="WAVE" {{ old('moyen_paiement') == 'WAVE' ? 'selected' : '' }}>WAVE</option>
                <option value="OM" {{ old('moyen_paiement') == 'OM' ? 'selected' : '' }}>OM</option>
            </select>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Effectuer la Cotisation</button>
    </form>
</div>
@endsection
