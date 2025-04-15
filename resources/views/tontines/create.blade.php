
@extends('app')


@section('content')
<div class="container">
    <h1>Créer une nouvelle Tontine</h1>

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

    <!-- Formulaire pour créer une nouvelle tontine -->
    <form action="{{ route('tontines.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="libelle" class="form-label">Libellé</label>
            <input type="text" name="libelle" class="form-control" id="libelle" value="{{ old('libelle') }}" required>
        </div>

        <div class="mb-3">
            <label for="frequence" class="form-label">Fréquence</label>
            <input type="text" name="frequence" class="form-control" id="frequence" value="{{ old('frequence') }}" required>
        </div>

        <div class="mb-3">
            <label for="dateDebut" class="form-label">Date de début</label>
            <input type="date" name="dateDebut" class="form-control" id="dateDebut" value="{{ old('dateDebut') }}" required>
        </div>

        <div class="mb-3">
            <label for="dateFin" class="form-label">Date de fin</label>
            <input type="date" name="dateFin" class="form-control" id="dateFin" value="{{ old('dateFin') }}" required>
        </div>

        <div class="mb-3">
            <label for="montant_total" class="form-label">Montant total</label>
            <input type="number" name="montant_total" class="form-control" id="montant_total" value="{{ old('montant_total') }}" required>
        </div>

        <div class="mb-3">
            <label for="montant_de_base" class="form-label">Montant de base</label>
            <input type="number" name="montant_de_base" class="form-control" id="montant_de_base" value="{{ old('montant_de_base') }}" required>
        </div>

        <div class="mb-3">
            <label for="nbreParticipant" class="form-label">Nombre de participants</label>
            <input type="number" name="nbreParticipant" class="form-control" id="nbreParticipant" value="{{ old('nbreParticipant') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn bg-gold text-white">Créer la Tontine</button>

    </form>
</div>
@endsection



