@extends('app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-gold"><i class="fas fa-wallet me-2"></i>Cotisations - {{ $tontine->libelle }}</h2>

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i>Retour à mes tontines
    </a>

    @if($cotisations->isEmpty())
        <div class="alert alert-warning shadow-sm">
            <i class="fas fa-exclamation-circle me-2"></i>Aucune cotisation effectuée.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Montant</th>
                        <th>Moyen de paiement</th>
                        <th>Date</th>
                        <th>État</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotisations as $cotisation)
                        <tr>
                            <td>{{ number_format($cotisation->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $cotisation->moyen_paiement }}</td>
                            <td>{{ $cotisation->created_at->format('d/m/Y à H:i') }}</td>
                            <td>
                                @if ($cotisation->etat_paiement === 'PAYE')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Payé</span>
                                @elseif ($cotisation->etat_paiement === 'EN_ATTENTE')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i>En attente</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Annulé</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('cotisations.user.manquantes', $tontine->id) }}" class="btn btn-outline-danger mt-4">
        <i class="fas fa-calendar-times me-2"></i>Voir les cotisations manquantes
    </a>

    <style>
        .text-gold {
            color: #DAA520;
        }
    </style>
</div>
@endsection
