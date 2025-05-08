@extends('app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-gold"><i class="fas fa-edit mr-2"></i>Modifier la tontine : {{ $tontine->libelle }}</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
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
                    <input type="date" name="dateDebut" id="dateDebut" class="form-control"
                        value="{{ \Carbon\Carbon::parse($tontine->dateDebut)->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="dateFin">Date de fin</label>
                    <input type="date" name="dateFin" id="dateFin" class="form-control"
                        value="{{ \Carbon\Carbon::parse($tontine->dateFin)->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $tontine->description }}</textarea>
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

                <button type="submit" class="btn btn-gold">
                    <i class="fas fa-save mr-1"></i>Mettre à jour
                </button>
            </form>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-1"></i>Retour
    </a>
</div>

{{-- Styles --}}
<style>
    .text-gold {
        color: #DAA520;
    }
    .btn-gold {
        background-color: #DAA520;
        color: white;
        font-weight: 600;
        border-radius: 6px;
    }
    .btn-gold:hover {
        background-color: #c59c1c;
        color: white;
    }
</style>
@endsection
