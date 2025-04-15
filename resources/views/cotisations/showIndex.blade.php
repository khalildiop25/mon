@extends('app')

@section('content')
<div class="container">
    <h1>Cotisations pour la Tontine : {{ $tontine->libelle }}</h1>

    <!-- Message de succès, si applicable -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Liste des cotisations -->
    @if($cotisations->isEmpty())
        <div class="alert alert-info">
            Aucune cotisation effectuée pour cette tontine.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Cotisation</th>
                    <th>Participant</th>
                    <th>Montant</th>
                    <th>Moyen de paiement</th>
                    <th>Date</th>
                    <th>État du paiement</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotisations as $cotisation)
                    <tr>
                        <td>{{ $cotisation->id }}</td>
                        <td>{{ $cotisation->user->nom }} {{ $cotisation->user->prenom }}</td>
                        <td>{{ $cotisation->montant }} FCFA</td>
                        <td>{{ $cotisation->moyen_paiement }}</td>
                        <td>{{ $cotisation->created_at->format('d M Y à H:i') }}</td>
                        <td>
                            @if ($cotisation->etat_paiement == 'EN_ATTENTE')
                                <span class="badge bg-warning">En Attente</span>
                            @elseif ($cotisation->etat_paiement == 'PAYE')
                                <span class="badge bg-success">Payé</span>
                            @else
                                <span class="badge bg-danger">Annulé</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Affichage de la somme totale des cotisations -->
        <div class="d-flex justify-content-between">
            <strong>Total des cotisations :</strong>
            <strong>{{ $cotisations->sum('montant') }} FCFA</strong>
        </div>

        <!-- Pagination des cotisations -->
        {{ $cotisations->links() }}
    @endif

    <!-- Bouton pour revenir à la liste des tontines -->
    <a href="{{ route('cotisations.tontines.list') }}" class="btn btn-secondary">Retour aux tontines</a>
</div>

@endsection
