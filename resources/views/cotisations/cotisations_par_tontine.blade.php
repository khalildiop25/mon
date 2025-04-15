@extends('app')

@section('content')
<div class="container">
    <h2>Cotisations - {{ $tontine->libelle }}</h2>

    <a href="{{ route('cotisations.user') }}" class="btn btn-secondary mb-3">Retour à mes tontines</a>

    @if($cotisations->isEmpty())
        <div class="alert alert-warning">Aucune cotisation effectuée.</div>
    @else
        <table class="table table-bordered">
            <thead>
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
                        <td>{{ $cotisation->montant }} FCFA</td>
                        <td>{{ $cotisation->moyen_paiement }}</td>
                        <td>{{ $cotisation->created_at->format('d/m/Y à H:i') }}</td>
                        <td>
                            @if ($cotisation->etat_paiement === 'PAYE')
                                <span class="badge bg-success">Payé</span>
                            @elseif ($cotisation->etat_paiement === 'EN_ATTENTE')
                                <span class="badge bg-warning">En attente</span>
                            @else
                                <span class="badge bg-danger">Annulé</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Bouton pour voir les cotisations manquantes -->
    <a href="{{ route('cotisations.user.manquantes', $tontine->id) }}" class="btn btn-outline-danger mt-3">
        Voir les cotisations manquantes
    </a>
</div>
@endsection
