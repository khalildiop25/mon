@extends('app')

@section('content')
<div class="container mt-4">
    {{-- Messages de succès/erreur --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <h2 class="mb-4 text-gold"><i class="fas fa-random mr-2"></i>Participer au tirage</h2>

    @foreach($tontines as $tontine)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <strong>{{ $tontine->libelle }}</strong>
                <span class="badge badge-info ml-2">Fréquence : {{ ucfirst(strtolower($tontine->frequence)) }}</span>
            </div>
            <div class="card-body">
                @php
                    $now = \Carbon\Carbon::now();
                    $canParticipate = false;
                    $prochainTirage = null;

                    switch (strtoupper($tontine->frequence)) {
                        case 'JOURNALIERE':
                            $canParticipate = true;
                            $prochainTirage = $now->copy()->format('d/m/Y');
                            break;
                        case 'HEBDOMADAIRE':
                            $canParticipate = $now->isMonday();
                            $prochainTirage = $now->copy()->next(\Carbon\Carbon::MONDAY)->format('d/m/Y');
                            break;
                        case 'MENSUEL':
                            $canParticipate = $now->day === 1;
                            $prochainTirage = $now->copy()->addMonthNoOverflow()->firstOfMonth()->format('d/m/Y');
                            break;
                    }

                    $alreadyParticipated = $tontine->tirages()
                        ->where('idUser', auth()->id())
                        ->whereDate('created_at', $now->toDateString())
                        ->exists();
                @endphp

                <p class="mb-2"><strong>Date du prochain tirage :</strong> {{ $prochainTirage ?? 'Non défini' }}</p>

                <form action="{{ route('tirages.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
                    <button type="submit"
                            class="btn btn-warning text-white"
                            {{ !$canParticipate || $alreadyParticipated ? 'disabled' : '' }}>
                        <i class="fas fa-ticket-alt mr-1"></i>
                        {{ $alreadyParticipated ? 'Déjà participé' : 'Participer au tirage' }}
                    </button>
                </form>
            </div>
        </div>
    @endforeach

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-1"></i>Retour
    </a>
</div>

{{-- Styles personnalisés --}}
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
