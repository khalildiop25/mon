@extends('app')

@section('content')
<div class="container mt-4">
    <h2 class="text-gold"><i class="fas fa-users mr-2"></i>Participants de la Tontine: {{ $tontine->libelle }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Si la tontine n'a pas de participants -->
            @if($tontine->participants->isEmpty())
                <div class="alert alert-warning">
                    Aucun participant inscrit à cette tontine pour le moment.
                </div>
            @else
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse</th>
                            <th>CNI</th>
                            <th>Date de naissance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tontine->participants as $participant)
                            <tr>
                                <td>{{ $participant->id }}</td>
                                <td>{{ $participant->user->nom }}</td>
                                <td>{{ $participant->user->prenom }}</td>
                                <td>{{ $participant->adresse }}</td>
                                <td>{{ $participant->cni }}</td>
                                <td>{{ \Carbon\Carbon::parse($participant->dateNaissance)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Bouton retour -->
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">
        <i class="fas fa-arrow-left mr-1"></i>Retour à la liste des tontines
    </a>
</div>

{{-- Styles --}}
<style>
    .text-gold {
        color: #DAA520;
    }
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>
@endsection
