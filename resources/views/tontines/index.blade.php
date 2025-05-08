@extends('app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-gold"><i class="fas fa-list-ul mr-2"></i>Liste des Tontines</h2>
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($tontines->count() == 0)
        <div class="alert alert-warning shadow-sm">
            <i class="fas fa-exclamation-circle mr-2"></i>Aucune tontine disponible.
        </div>
    @else
    <div class="mb-3 d-flex justify-content-between align-items-center">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-0">
        <i class="fas fa-arrow-left mr-1"></i>Retour
    </a>

    <a href="{{ route('tontines.create') }}" class="btn btn-gold shadow-sm">
        <i class="fas fa-plus mr-1"></i>Créer une Tontine
    </a>
</div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Libellé</th>
                                <th>Fréquence</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Montant total</th>
                                <th>Participants</th>
                                <th class="text-center">Actions</th>
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
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info btn-sm mr-1 w-100">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tontines.participants', $tontine->id) }}" class="btn btn-primary btn-sm w-100">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                            </div>
                                            <div class="d-flex">
                                                <a href="{{ route('tontines.edit', $tontine->id) }}" class="btn btn-warning btn-sm mr-1 w-100">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tontines.destroy', $tontine->id) }}" method="POST" class="w-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tontine ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-3">
        {{ $tontines->links() }}
    </div>
</div>

{{-- Style spécifique --}}
<style>
    .text-gold {
        color: #DAA520;
    }
    .btn-gold {
        background-color: #DAA520;
        color: white;
        border-radius: 8px;
        font-weight: 600;
    }
    .btn-gold:hover {
        background-color: #cfa216;
        color: white;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endsection
