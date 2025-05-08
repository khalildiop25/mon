@extends('app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Liste des Participants</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Retour
        </a>
    </div>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border border-2 border-primary-subtle">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Adresse</th>
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
                                <td>{{ $participant->adresse }}</td>
                                <td>{{ $participant->user->email }}</td>
                                <td>{{ $participant->user->telephone }}</td>
                                <td>{{ $participant->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-3">
                                        <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-sm btn-outline-info">Détails</a>
                                        <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-sm btn-outline-warning">Éditer</a>
                                        <a href="{{ route('participant.tontines', $participant->id) }}" class="btn btn-sm btn-outline-primary">Tontines</a>
                                        <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
