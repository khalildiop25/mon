@extends('app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left mr-2"></i>Retour
    </a>

    <h2 class="mb-4 text-gold"><i class="fas fa-users mr-2"></i>Mes Tontines</h2>

    @if($tontines->isEmpty())
        <div class="alert alert-info shadow-sm">
            <i class="fas fa-info-circle mr-2"></i>Vous ne participez à aucune tontine.
        </div>
    @else
        <div class="card shadow-sm">
            <ul class="list-group list-group-flush">
                @foreach($tontines as $tontine)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">{{ $tontine->libelle }}</span>
                        <a href="{{ route('cotisations.user.tontine', $tontine->id) }}" class="btn btn-sm btn-warning text-white">
                            <i class="fas fa-wallet mr-1"></i>Voir mes cotisations
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<style>
    .text-gold {
        color: #DAA520;
    }
    .btn-warning {
        background-color: #DAA520;
        border-color: #DAA520;
    }
    .btn-warning:hover {
        background-color: #c59c1c;
        border-color: #c59c1c;
    }
</style>
@endsection
