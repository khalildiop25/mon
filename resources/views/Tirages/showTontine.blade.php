@@extends('app')

@section('content')
    <div class="container">
        <h1>Tirages de la tontine : {{ $tontine->libelle }}</h1>
        
        <!-- Message de succès, si applicable -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Affichage des détails de la tontine -->
        <div class="mb-4">
            <strong>Libellé:</strong> {{ $tontine->libelle }} <br>
            <strong>Fréquence:</strong> {{ $tontine->frequence }} <br>
            <strong>Description:</strong> {{ $tontine->description }} <br>
            <strong>Date de début:</strong> {{ $tontine->dateDebut->format('d-m-Y') }} <br>
            <strong>Date de fin:</strong> {{ $tontine->dateFin->format('d-m-Y') }} <br>
            <strong>Montant total:</strong> {{ $tontine->montant_total }} <br>
        </div>

        <!-- Table des tirages -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Tontine</th>
                    <th>Date du tirage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tirages as $tirage)
                    <tr>
                        <td>{{ $tirage->user->name }}</td>
                        <td>{{ $tirage->tontine->libelle }}</td>
                        <td>{{ $tirage->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun tirage pour cette tontine</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Ajouter un tirage -->
        <a href="{{ route('tirages.create') }}" class="btn btn-primary">Ajouter un tirage</a>
    </div>
@endsection



