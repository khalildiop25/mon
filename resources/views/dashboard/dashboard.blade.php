@extends('app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Participants -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Participants
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nombreParticipants }}</div>
                </div>
            </div>
        </div>

        <!-- Tontines Actives -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Tontines Actives
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nombreTontinesActives }}</div>
                </div>
            </div>
        </div>

        <!-- Tirages Effectués -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Tirages Effectués
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nombreTirages }}</div>
                </div>
            </div>
        </div>
{{--
        <!-- Fonds Disponibles -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Fonds Disponibles
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ number_format($montantTotalFonds, 0, ',', ' ') }} FCFA
                    </div>
                </div>
            </div>
        </div>
    </div>
--}}
    <!-- Graphique -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Participants par Tontine</h6>
        </div>
        <div class="card-body">
            <canvas id="participantsChart" height="100"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('participantsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($participantsParTontine->pluck('libelle')) !!},
            datasets: [{
                label: 'Participants',
                data: {!! json_encode($participantsParTontine->pluck('participants_count')) !!},
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endpush
