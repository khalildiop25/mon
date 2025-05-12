 <!-- Section pour les liens des tontines -->
 <div class="mt-5" style="background-color:#eff2f8;">
    <h2 class=" display-4 fw-bold text-primary">Toutes nos Tontines</h2>

    @if ($tontines->isEmpty())
        <p class="text-center fs-3">Aucune tontine n'est disponible pour l'instant.</p>
    @else
        <div class="row">
            @foreach ($tontines as $tontine)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 rounded-3">
                        @if ($tontine->images)
                            <img src="{{ asset('storage/' . $tontine->images->first()->nomImage) }}"
                                alt="Image de la tontine" class="card-img-top"
                                style="width: 100%; height: auto; object-fit: contain;">
                        @else
                            <img src="{{ asset('images/default-tontine.jpg') }}" alt="Image par défaut"
                                class="card-img-top"
                                style="width: 100%; height: auto; object-fit: contain;">
                        @endif


                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">{{ $tontine->libelle }}</h5>
                            <p class="card-text mb-2">
                                <strong>Montant :</strong>
                                {{ number_format($tontine->montant_total, 0, ',', ' ') }}
                                FCFA<br>
                                <strong>Fréquence :</strong> {{ $tontine->frequence }}<br>
                                <strong>Participants :</strong> {{ $tontine->nbreParticipant }}
                            </p>

                            <button
                                class="btn btn-outline-info btn-sm mt-auto toggle-details  text-gray-900  pr-3 text-lg">
                                Voir les détails <i
                                    class="bi bi-chevron-down ml-2 text-3xl text-gray-900"></i>
                            </button>




                            <div class="details mt-3" style="display: none;">
                                <p><strong>Date début :</strong> {{ $tontine->dateDebut }}</p>
                                <p><strong>Date fin :</strong> {{ $tontine->dateFin }}</p>
                                <p><strong>Description :</strong> {{ $tontine->description }}</p>
                                <p><strong>Montant de base :</strong>
                                    {{ number_format($tontine->montant_de_base, 0, ',', ' ') }} FCFA</p>
                                @if (!Auth::check())
                                    <!-- Affichage du bouton "Participer" si l'utilisateur est un participant -->
                                    <a href="{{ route('tontines.participer', $tontine->id) }}"
                                        class="btn btn-success">Participer à la Tontine</a>
                                @elseif(auth()->user()->profil == 'PARTICIPANT')
                                    <!-- Affichage du bouton "Participer" si l'utilisateur est un participant -->
                                    <a href="{{ route('tontines.participer', $tontine->id) }}"
                                        class="btn btn-success">Participer à la Tontine</a>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach
    @endif
</div>
