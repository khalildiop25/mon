@extends('app')

@section('content')
<div class="container">
    <h1>Participants de la Tontine: {{ $tontine->libelle }}</h1>

    <!-- Si la tontine n'a pas de participants -->
    @if($tontine->participants->isEmpty())
        <div class="alert alert-warning">
            Aucun participant inscrit à cette tontine pour le moment.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>adresse</th>
                    <th>cni</th>
                    <th>dateNaissance</th>
                    
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
                        <td>{{ $participant->dateNaissance }}</td>
                        <td>
                            <!-- Action supplémentaire ici si nécessaire -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('tontines.index') }}" class="btn btn-secondary">Retour à la liste des tontines</a>
</div>
@endsection
