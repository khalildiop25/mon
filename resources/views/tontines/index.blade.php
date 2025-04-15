@extends('app')

@section('content')
<div class="container">
    <h1>Liste des Tontines</h1>

    <!-- Message de succès s'il y en a -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Message si aucune tontine n'est disponible -->
    @if($tontines->count() == 0)
    <div class="alert alert-warning">
        Aucune tontine disponible.
    </div>
    @else
        <!-- Tableau des tontines -->
        <div class="mb-3">
            <a href="{{ route('tontines.create') }}" class="btn bg-gold text-white">Créer une Tontine</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Fréquence</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Montant total</th>
                    <th>Participants</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tontines as $tontine)
                    <tr>
                        <td>{{ $tontine->id }}</td>
                        <td>{{ $tontine->libelle }}</td>
                        <td>{{ $tontine->frequence }}</td>
                        <td>{{ $tontine->dateDebut->format('d/m/Y') }}</td>
                        <td>{{ $tontine->dateFin->format('d/m/Y') }}</td>
                        <td>{{ number_format($tontine->montant_total, 2, ',', ' ') }} FCFA</td>
                        <td>{{ $tontine->nbreParticipant }}</td>
                        <td>
    <div class="container px-0">
        <div class="row mb-1">
            <div class="col-6 pr-1">
                <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info btn-sm w-100">Voir</a>
            </div>
            <div class="col-6 pl-1">
                <a href="{{ route('tontines.participants', $tontine->id) }}" class="btn btn-primary btn-sm w-100">Participants</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 pr-1">
                <a href="{{ route('tontines.edit', $tontine->id) }}" class="btn btn-warning btn-sm w-100">Modifier</a>
            </div>
            <div class="col-6 pl-1">
                <form action="{{ route('tontines.destroy', $tontine->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tontine ?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Pagination si nécessaire -->
    {{ $tontines->links() }}
</div>
@endsection
