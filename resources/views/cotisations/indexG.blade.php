@extends('app')

@section('content')
<div class="container mt-4">

    {{-- Bouton retour --}}
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Retour
    </a>

    <h1 class="mb-4 text-gold">Gestion des Cotisations</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>   
                    <th>ID Participant</th>
                    <th>Tontine</th>
                    <th>Montant</th>
                    <th>Moyen de paiement</th>
                    <th>État du paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cotisations as $cotisation)
                    <tr>
                        <td>{{ $cotisation->id }}</td>
                        <td>{{ $cotisation->user->id }}</td>
                        <td>{{ $cotisation->tontine->libelle }}</td>
                        <td>{{ $cotisation->montant }} FCFA</td>
                        <td>{{ $cotisation->moyen_paiement }}</td>
                        <td>
                            @if ($cotisation->etat_paiement == 'EN_ATTENTE')
                                <span class="badge bg-warning">En attente</span>
                            @elseif ($cotisation->etat_paiement == 'PAYE')
                                <span class="badge bg-success">Payé</span>
                            @elseif ($cotisation->etat_paiement == 'ANNULE')
                                <span class="badge bg-danger">Annulé</span>
                            @endif
                        </td>
                        <td>
                            @if ($cotisation->etat_paiement == 'EN_ATTENTE')
                                <form action="{{ route('cotisations.valider', $cotisation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir valider cette cotisation ?');">Valider</button>
                                </form>

                                <form action="{{ route('cotisations.annuler', $cotisation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette cotisation ?');">Annuler</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Aucune cotisation disponible pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $cotisations->links() }}
    </div>
</div>
@endsection
