@extends('app')

@section('content')
<div class="container mt-5">
    <div class=" text-white d-flex justify-content-between align-items-center">
        <h2 class="text-gold">Détails de la Tontine</h2>
        <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    </div>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="card shadow rounded">
        <div class="card-header bg-gold text-white">
            <h5 class="mb-0">Tontine #{{ $tontine->id }} : {{ $tontine->libelle }}</h5>
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-md-6">
                    <p><strong>Fréquence :</strong> {{ $tontine->frequence }}</p>
                    <p><strong>Date de début :</strong> {{ $tontine->dateDebut->format('d/m/Y') }}</p>
                    <p><strong>Date de fin :</strong> {{ $tontine->dateFin->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Montant total :</strong> {{ number_format($tontine->montant_total, 2, ',', ' ') }} FCFA</p>
                    <p><strong>montant_de_base :</strong> {{ number_format($tontine->montant_de_base, 2, ',', ' ') }} FCFA</p>
                    <p><strong>Participants :</strong> {{ $tontine->nbreParticipant }}</p>
                </div>
                <div class="col-12">
                    <p><strong>Description :</strong></p>
                    <div class="bg-light p-3 rounded">{{ $tontine->description }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        @if(auth()->check() && auth()->user()->profil == 'GERANT')
            <a href="{{ route('tontines.edit', $tontine->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>

            <form action="{{ route('tontines.destroy', $tontine->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tontine ?')" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </form>
        @elseif(auth()->check() && auth()->user()->profil == 'PARTICIPANT')
        <a href="#" id="btn-participer" class="btn btn-success">
    <i class="fas fa-handshake"></i> Participer à la Tontine
</a>

                <i class="fas fa-handshake"></i> Participer à la Tontine
            </a>
        @elseif(!auth()->check())
            <a href="{{ route('tontines.participer', $tontine->id) }}" class="btn btn-success">
                <i class="fas fa-handshake"></i> Participer à la Tontine
            </a>
        @endif
    </div>
    <style>
        .text-gold {
            color: #DAA520;
        }
        .bg-gold {
            background-color: #DAA520;
        }
        .gap-2 {
            gap: 0.5rem;
        }
    </style>
    <!-- Modal de contrat (Bootstrap 4) -->
<div class="modal fade" id="contratModal" tabindex="-1" role="dialog" aria-labelledby="contratModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gold text-white">
        <h5 class="modal-title" id="contratModalLabel">Contrat de Participation</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          En cliquant sur "Accepter", vous vous engagez à respecter les règles de la tontine 
          <strong>{{ $tontine->libelle }}</strong>, y compris les contributions régulières et les conditions de retrait.
        </p>
        <p>
          Toute participation est un engagement moral et financier. En cas de manquement, vous pourrez être exclu ou faire face à des pénalités.
        </p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('tontines.participer', $tontine->id) }}" method="GET">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-check-circle"></i> Accepter
          </button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fas fa-times-circle"></i> Annuler
        </button>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#btn-participer').on('click', function (e) {
            e.preventDefault();
            $('#contratModal').modal('show');
        });
    });
</script>
@endsection

</div>
@endsection
