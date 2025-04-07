@extends('app')

@section('content')
<div class="container">
    <h1>Ajouter une Cotisation à la Tontine</h1>

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

    <!-- Formulaire pour ajouter une cotisation -->
    <form action="{{ route('cotisations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tontine_id" class="form-label">Tontine</label>
            <select name="tontine_id" id="tontine_id" class="form-control @error('tontine_id') is-invalid @enderror" required>
                <option value="" disabled selected>Sélectionner une tontine</option>
                @foreach($tontines as $tontine)
                    <option value="{{ $tontine->id }}" {{ old('tontine_id') == $tontine->id ? 'selected' : '' }}>
                        {{ $tontine->libelle }} ({{ $tontine->nbreParticipant }} participants)
                    </option>
                @endforeach
            </select>
            @error('tontine_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="montant" class="form-label">Montant de la cotisation</label>
            <input type="number" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}" required>
            @error('montant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="participant_id" class="form-label">Participant</label>
            <select name="participant_id" id="participant_id" class="form-control @error('participant_id') is-invalid @enderror" required>
                <option value="" disabled selected>Sélectionner un participant</option>
                @foreach($participants as $participant)
                    <option value="{{ $participant->id }}" {{ old('participant_id') == $participant->id ? 'selected' : '' }}>
                        {{ $participant->nom }} ({{ $participant->email }})
                    </option>
                @endforeach
            </select>
            @error('participant_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter la Cotisation</button>
    </form>
</div>
@endsection
