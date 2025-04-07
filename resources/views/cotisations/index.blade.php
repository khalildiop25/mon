@extends('app')

@section('content')
    <div class="container">
        <h1>Liste des cotisations pour le participant : {{ $participant->user->nom }}</h1>

        <!-- Message de succès, si applicable -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Vérifie si la variable $cotisations est bien définie -->
        @if($cotisations->isEmpty())
            <div class="alert alert-info">
                Aucune cotisation disponible pour ce participant.
            </div>
        @else
            <!-- Liste des cotisations -->
            <table class="table table-bordered">
                <thead>
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
                            <td>{{ $cotisation->tontine->libelle }}</td>  <!-- Nom de la tontine -->
                            <td>{{ $cotisation->montant }} FCFA</td>  <!-- Montant de la cotisation -->
                            <td>{{ $cotisation->moyen_paiement }}</td>  <!-- Moyen de paiement -->
                            <td>{{ $cotisation->created_at->format('d M Y à H:i') }}</td>  <!-- Date de la cotisation -->
                            <td>
                                <!-- Affiche l'état de paiement (EN_ATTENTE, PAYE, ANNULE) -->
                                @if($cotisation->etat_paiement == 'EN_ATTENTE')
                                    <span class="badge bg-warning">En Attente</span>
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

            <!-- Pagination des cotisations -->
            {{ $cotisations->links() }}
        @endif

        <!-- Bouton pour ajouter une nouvelle cotisation -->
        <a href="{{ route('cotisations.create') }}" class="btn btn-primary">Ajouter une cotisation</a>
    </div>
@endsection
