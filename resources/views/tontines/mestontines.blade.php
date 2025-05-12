@extends('app')

@section('content')
<style>
    .titre-tontine {
    color: #1a365d; /* doré personnalisé */
}

    </style>
    <div class="container" style="background-color:#e3eaf6;">
        {{--<h2 class="mb-4 display-4 fw-bold text-primary">Tontines de {{ $participant->user->prenom }} {{ $participant->user->nom }}</h2>--}}
        <h2 class="mb-4 display-4 fw-bold titre-tontine">
            Tontines de {{ $participant->user->prenom }} {{ $participant->user->nom }}
        </h2>

        @if ($tontines->isEmpty())
            <div class="alert alert-info">
                Vous n'avez participé à aucune tontine pour le moment.
            </div>
        @else
            <div class="row">
                @foreach ($tontines as $tontine)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 rounded-3">
                            @if ($tontine->images)
                                <img src="{{ asset('storage/' . $tontine->images->nomImage) }}" alt="Image de la tontine"
                                    class="card-img-top" style="width: 100%; height: auto; object-fit: contain;"
                                    >
                            @else
                                <img src="{{ asset('images/default-tontine.png') }}" alt="Image par défaut"
                                    class="card-img-top" style="width: 100%; height: auto; object-fit: contain;"
                                    >
                            @endif


                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-primary">{{ $tontine->libelle }}</h5>
                                <p class="card-text mb-2">
                                    <strong>Montant :</strong> {{ number_format($tontine->montant_total, 0, ',', ' ') }}
                                    FCFA<br>
                                    <strong>Fréquence :</strong> {{ $tontine->frequence }}<br>
                                    <strong>Participants :</strong> {{ $tontine->nbreParticipant }}
                                </p>
                               <!--hh<button class="btn btn-outline-info btn-sm mt-auto toggle-details">
                                    Voir les détails <i class="bi bi-chevron-down"></i>nnn
                                </button>n-->
                                <button class="btn btn-outline-info btn-sm mt-auto toggle-details  text-gray-900  pr-3 text-lg">
                                    Voir les détails <i class="bi bi-chevron-down ml-2 text-3xl text-gray-900"></i>
                                </button>




                                <div class="details mt-3" style="display: none;">
                                    <p><strong>Date début :</strong> {{ $tontine->dateDebut }}</p>
                                    <p><strong>Date fin :</strong> {{ $tontine->dateFin }}</p>
                                    <p><strong>Description :</strong> {{ $tontine->description }}</p>
                                    <p><strong>Montant de base :</strong>
                                        {{ number_format($tontine->montant_de_base, 0, ',', ' ') }} FCFA</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', () => {
                const details = button.nextElementSibling;
                const icon = button.querySelector('i');
                const isVisible = details.style.display === 'block';

                details.style.display = isVisible ? 'none' : 'block';
                icon.classList.toggle('bi-chevron-down', isVisible);
                icon.classList.toggle('bi-chevron-up', !isVisible);
            });
        });
    </script>
@endsection
