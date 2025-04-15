@extends('app')

@section('content')
<div class="container">
    <h1>Participants de la Tontine : {{ $tontine->libelle }}</h1>

    @if($participants->isEmpty())
        <div class="alert alert-info">
            Aucun participant pour cette tontine.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du participant</th>
                    <th>Action</th> <!-- Nouveau bouton Status -->
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $participant)
                    <tr>
                        <td>{{ $participant->user->nom }} {{ $participant->user->prenom }}</td>
                        <td>
                            <!-- Button to open the modal -->
                            <button class="btn btn-info" data-toggle="modal" data-target="#statusModal" data-participant-id="{{ $participant->id }}">
                                Voir les dates manquantes
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('cotisations.tontines2') }}" class="btn btn-secondary">Retour aux tontines</a>
</div>

<!-- Modal structure -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">Dates Manquantes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalContent">
            <!-- Les dates manquantes seront affichées ici -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

@endsection

<!-- JavaScript to handle modal interactions -->
@section('scripts')
<script>
    const tontineId = {{ $tontine->id }};
   // Lorsque le modal #statusModal est sur le point de s'ouvrir
// Quand le modal s'ouvre
$('#statusModal').on('show.bs.modal', function (event) {
    // Récupère le bouton qui a déclenché l'ouverture du modal
    var button = $(event.relatedTarget);

    // Récupère l'ID du participant depuis l'attribut HTML
    var participantId = button.data('participant-id');

    // Cible le modal HTML
    var modal = $(this);

    // Effectue une requête AJAX vers le contrôleur
    $.ajax({
        url: '/participant/' + participantId + '/dates-manquantes',
        method: 'GET',
        data: { tontine_id: {{ $tontine->id }} }, // Envoie aussi l’ID de la tontine
        success: function(response) {
            if(response.datesManquantes.length > 0) {
                var datesHtml = '<ul class="list-group">';

                // Boucle sur chaque date manquante reçue
                response.datesManquantes.forEach(function(date) {
                    // Ajoute un <li> par date
                    datesHtml += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    datesHtml += date.label;

                    // Si c’est la dernière, ajoute un badge
                    if (date.last) {
                        datesHtml += '<span class="badge badge-warning badge-pill">Dernière</span>';
                    }

                    datesHtml += '</li>';
                });

                datesHtml += '</ul>';

                // Affiche les dates dans le modal
                modal.find('#modalContent').html(datesHtml);
            } else {
                // Aucun retard
                modal.find('#modalContent').html('<p>Participant à jour (aucune date manquante).</p>');
            }
        },
        error: function(xhr, status, error) {
            // Si erreur AJAX
            modal.find('#modalContent').html('<p>Erreur lors du chargement des données.</p>');
        }
    });
});


</script>

@endsection
