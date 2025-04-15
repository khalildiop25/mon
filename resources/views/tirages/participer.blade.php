@extends('app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <h2>Participer au tirage</h2>

    @foreach($tontines as $tontine)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $tontine->libelle }}</strong> - Fréquence : {{ $tontine->frequence }}
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


                <p><strong>Date du prochain tirage :</strong> {{ $prochainTirage ?? 'Non défini' }}</p>

                <form action="{{ route('tirages.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
                    <button type="submit"
                            class="btn btn-primary"
                            {{ !$canParticipate || $alreadyParticipated ? 'disabled' : '' }}>
                        {{ $alreadyParticipated ? 'Déjà participé' : 'Participer au tirage' }}
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
