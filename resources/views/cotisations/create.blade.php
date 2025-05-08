@extends('app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-gold"><i class="fas fa-hand-holding-usd me-2"></i>Effectuer une Cotisation</h2>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de cotisation -->
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('cotisations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idUser" value="{{ auth()->id() }}">

                <!-- Tontine -->
                <div class="mb-3">
                    <label for="idTontine" class="form-label fw-bold">Tontine</label>
                    <select name="idTontine" id="idTontine" class="form-select" required>
                        <option value="" disabled selected>-- Sélectionner une tontine --</option>
                        @foreach($tontines as $tontine)
                            <option value="{{ $tontine->id }}" {{ old('idTontine') == $tontine->id ? 'selected' : '' }}>
                                {{ $tontine->libelle }} ({{ $tontine->nbreParticipant }} participants)
                                @if($tontine->frequence) - {{ $tontine->frequence }} @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Montant -->
                <div class="mb-3">
                    <label for="montant" class="form-label fw-bold">Montant de la cotisation (FCFA)</label>
                    <input type="number" name="montant" id="montant" class="form-control" value="{{ old('montant') }}" required min="1" placeholder="Ex: 5000">
                </div>

                <!-- Moyen de paiement -->
                <div class="mb-3">
                    <label for="moyen_paiement" class="form-label fw-bold">Mode de paiement</label>
                    <select name="moyen_paiement" id="moyen_paiement" class="form-select" required>
                        <option value="" disabled selected>-- Sélectionner le mode de paiement --</option>
                        <option value="WAVE" {{ old('moyen_paiement') == 'WAVE' ? 'selected' : '' }}>WAVE</option>
                        <option value="OM" {{ old('moyen_paiement') == 'OM' ? 'selected' : '' }}>OM</option>
                    </select>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-gold w-100 fw-bold">
                    <i class="fas fa-paper-plane me-2"></i>Valider la Cotisation
                </button>
            </form>
        </div>
    </div>

    <style>
        .text-gold {
            color: #DAA520;
        }
        .btn-gold {
            background-color: #DAA520;
            color: #fff;
            border-radius: 8px;
        }
        .btn-gold:hover {
            background-color: #cfa216;
            color: white;
        }
    </style>
</div>
@endsection
