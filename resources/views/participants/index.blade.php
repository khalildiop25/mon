@extends('app')

@section('content')
<div class="container">
    <h1>Liste des Participants</h1>

    <!-- Affichage des erreurs de validation (si applicable) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tableau des participants -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date d'inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $participant)
                <tr>
                    <td>{{ $participant->id }}</td>
                    <td>{{ $participant->nom }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->telephone }}</td>
                    <td>{{ $participant->created_at->format('d/m/Y') }}</td>
                    <td>
                        <!-- Lien pour voir plus de détails sur le participant -->
                        <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-info btn-sm">Détails</a>

                        <!-- Lien pour éditer un participant -->
                        <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning btn-sm">Éditer</a>

                        <!-- Ajouter le bouton "Tontines Participer" entre "Éditer" et "Supprimer" -->
                        <a href="{{ route('participant.tontines', $participant->id) }}" class="btn btn-primary btn-sm">Tontines Participer</a>

                        <!-- Formulaire pour supprimer un participant -->
                        <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce participant ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination des participants si nécessaire -->
    {{-- {{ $participants->links() }} --}}
</div>
@endsection
