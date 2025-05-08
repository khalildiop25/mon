@extends('app')

@section('content')
<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-gold mb-0">
        <i class="fas fa-plus-circle mr-2"></i>Créer une nouvelle Tontine
    </h2>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-1"></i>Retour
    </a>
</div>


    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <h5 class="mb-2"><i class="fas fa-exclamation-triangle"></i> Erreurs :</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('tontines.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="libelle">Libellé</label>
                    <input type="text" name="libelle" class="form-control" id="libelle" value="{{ old('libelle') }}" required>
                </div>

                <div class="form-group">
                    <label for="frequence">Fréquence</label>
                    <input type="text" name="frequence" class="form-control" id="frequence" value="{{ old('frequence') }}" required>
                </div>

                <div class="form-group">
                    <label for="dateDebut">Date de début</label>
                    <input type="date" name="dateDebut" class="form-control" id="dateDebut" value="{{ old('dateDebut') }}" required>
                </div>

                <div class="form-group">
                    <label for="dateFin">Date de fin</label>
                    <input type="date" name="dateFin" class="form-control" id="dateFin" value="{{ old('dateFin') }}" required>
                </div>

                <div class="form-group">
                    <label for="montant_total">Montant total</label>
                    <input type="number" name="montant_total" class="form-control" id="montant_total" value="{{ old('montant_total') }}" required>
                </div>

                <div class="form-group">
                    <label for="montant_de_base">Montant de base</label>
                    <input type="number" name="montant_de_base" class="form-control" id="montant_de_base" value="{{ old('montant_de_base') }}" required>
                </div>

                <div class="form-group">
                    <label for="nbreParticipant">Nombre de participants</label>
                    <input type="number" name="nbreParticipant" class="form-control" id="nbreParticipant" value="{{ old('nbreParticipant') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-gold">
                    <i class="fas fa-check-circle mr-1"></i>Créer la Tontine
                </button>
            </form>
        </div>
    </div>
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
