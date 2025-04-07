@extends('app')

@section('content')
    <div class="container">
        <h1>Liste des cotisations pour la Tontine: {{ $tontine->nom }}</h1>

        <!-- Message de succès, si applicable -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des cotisations -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Montant</th>
                    <th>Moyen de Paiement</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cotisations as $cotisation)
                    <tr>
                        <td>{{ $cotisation->user->name }}</td>  <!-- Nom de l'utilisateur -->
                        <td>{{ $cotisation->montant }} FCFA</td>  <!-- Montant de la cotisation -->
                        <td>{{ $cotisation->moyen_paiement }}</td>  <!-- Moyen de paiement -->
                        <td>{{ $cotisation->created_at->format('d-m-Y') }}</td>  <!-- Date de la cotisation -->
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton pour ajouter une nouvelle cotisation -->
        <a href="{{ route('cotisations.store') }}" class="btn btn-primary">Ajouter une cotisation</a>
    </div>
@endsection
