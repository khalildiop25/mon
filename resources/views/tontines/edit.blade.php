@extends('app')

@section('content')
    <div class="container">
        <h1>Modifier la tontine : {{ $tontine->libelle }}</h1>

        <!-- Formulaire de modification -->
        <form action="{{ route('tontines.update', $tontine->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input type="text" name="libelle" id="libelle" class="form-control" value="{{ $tontine->libelle }}" required>
            </div>
            <div class="form-group">
                <label for="frequence">Fréquence</label>
                <input type="text" name="frequence" id="frequence" class="form-control" value="{{ $tontine->frequence }}" required>
            </div>
            <div class="form-group">
                <label for="dateDebut">Date de début</label>
                <input type="date" name="dateDebut" id="dateDebut" class="form-control" value="{{ $tontine->dateDebut ? $tontine->dateDebut->format('d/m/Y') : 'Non définie' }}" required>
            </div>
            <div class="form-group">
                <label for="dateFin">Date de fin</label>
                <input type="date" name="dateFin" id="dateFin" class="form-control" value="{{ $tontine->dateFin ? $tontine->dateFin->format('d/m/Y') : 'Non définie' }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $tontine->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="montant_total">Montant total</label>
                <input type="number" name="montant_total" id="montant_total" class="form-control" value="{{ $tontine->montant_total }}" required>
            </div>
            <div class="form-group">
                <label for="montant_de_base">Montant de base</label>
                <input type="number" name="montant_de_base" id="montant_de_base" class="form-control" value="{{ $tontine->montant_de_base }}" required>
            </div>
            <div class="form-group">
                <label for="nbreParticipant">Nombre de participants</label>
                <input type="number" name="nbreParticipant" id="nbreParticipant" class="form-control" value="{{ $tontine->nbreParticipant }}" required>
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
@endsection
