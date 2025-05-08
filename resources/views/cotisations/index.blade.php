@extends('app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-gold">Cotisations de : {{ $participant->user->nom }}</h2>
        <a href="{{ route('cotisations.create') }}" class="btn btn-gold">
            <i class="fas fa-plus-circle me-1"></i> Ajouter une cotisation
        </a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($cotisations->isEmpty())
        <div class="alert alert-info shadow-sm">
            <i class="fas fa-info-circle me-2"></i> Aucune cotisation disponible pour ce participant.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover shadow-sm rounded">
                <thead class="bg-gold text-white">
                    <tr>
                        <th>Tontine</th>
                        <th>Montant</th>
                        <th>Moyen de Paiement</th>
                        <th>Date</th>
                        <th>État de Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cotisations as $cotisation)
                        <tr>
                            <td>{{ $cotisation->tontine->libelle }}</td>
                            <td>{{ number_format($cotisation->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ ucfirst(strtolower($cotisation->moyen_paiement)) }}</td>
                            <td>{{ $cotisation->created_at->format('d M Y à H:i') }}</td>
                            <td>
                                @if($cotisation->etat_paiement == 'EN_ATTENTE')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($cotisation->etat_paiement == 'PAYE')
                                    <span class="badge bg-success">Payé</span>
                                @else
                                    <span class="badge bg-danger">Annulé</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $cotisations->links() }}
        </div>
    @endif
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i>Retour
    </a>
    <style>
        .text-gold {
            color: #DAA520;
        }
        .bg-gold {
            background-color: #DAA520 !important;
        }
        .btn-gold {
            background-color: #DAA520;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-gold:hover {
            background-color: #cfa216;
        }
    </style>
</div>
@endsection
