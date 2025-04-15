@extends('app')

@section('content')
<div class="container">
    <h1>Gestion des Cotisations</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
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
                            <!-- Formulaire pour valider une cotisation -->
                            <form action="{{ route('cotisations.valider', $cotisation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success" onclick="return confirm('Êtes-vous sûr de vouloir valider cette cotisation ?');">Valider</button>
                            </form>

                            <!-- Formulaire pour annuler une cotisation -->
                            <form action="{{ route('cotisations.annuler', $cotisation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette cotisation ?');">Annuler</button>
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

    <!-- Pagination -->
    {{ $cotisations->links() }}
</div>
@endsection
