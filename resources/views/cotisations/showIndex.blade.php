@extends('app')

@section('content')
<div class="container mt-4">

    {{-- Bouton de retour --}}
    <a href="{{ route('cotisations.tontines.list') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Retour aux tontines
    </a>

    {{-- Titre --}}
    <h2 class="mb-4 text-gold font-weight-bold">
        Cotisations pour la Tontine : {{ $tontine->libelle }}
    </h2>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger shadow-sm rounded">{{ session('error') }}</div>
    @endif

    {{-- Liste des cotisations --}}
    @if($cotisations->isEmpty())
        <div class="alert alert-info shadow-sm rounded">
            Aucune cotisation effectuée pour cette tontine.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm rounded">
                <thead class="thead-dark text-center ">
                    <tr>
                        <th>ID</th>
                        <th>Participant</th>
                        <th>Montant</th>
                        <th>Moyen de paiement</th>
                        <th>Date</th>
                        <th>État</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotisations as $cotisation)
                        <tr class="text-center align-middle">
                            <td>{{ $cotisation->id }}</td>
                            <td>{{ $cotisation->user->nom }} {{ $cotisation->user->prenom }}</td>
                            <td>{{ number_format($cotisation->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $cotisation->moyen_paiement }}</td>
                            <td>{{ $cotisation->created_at->format('d M Y à H:i') }}</td>
                            <td>
                                @if ($cotisation->etat_paiement == 'EN_ATTENTE')
                                    <span class="badge bg-warning text-dark">En Attente</span>
                                @elseif ($cotisation->etat_paiement == 'PAYE')
                                    <span class="badge bg-success">Payé</span>
                                @else
                                    <span class="badge bg-danger">Annulé</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total des cotisations --}}
        <div class="alert alert-light d-flex justify-content-between align-items-center shadow-sm rounded mt-3">
            <span class="font-weight-bold text-dark">Total des cotisations :</span>
            <span class="font-weight-bold text-gold">{{ number_format($cotisations->sum('montant'), 0, ',', ' ') }} FCFA</span>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $cotisations->links() }}
        </div>
    @endif

</div>
@endsection
