<ul class="navbar-nav sidebar sidebar-dark accordion bg-gold shadow-lg" id="accordionSidebar" style="font-size: 1.15rem;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-coins fa-2x"></i>
        </div>
        <div class="sidebar-brand-text mx-3 font-weight-bold text-uppercase text-white" style="font-size: 1.3rem;">SUNU KALPE</div>
    </a>

    <hr class="sidebar-divider my-0">

    <div class="sidebar-heading text-uppercase text-white py-3 font-weight-bold">
        ADMINISTRATEUR
    </div>

    <!-- Nav Item - Tontines -->
    <li class="nav-item active">
        <a class="nav-link py-3" href="#" data-toggle="collapse" data-target="#c" aria-expanded="true">
            <i class="fas fa-users fa-lg"></i>
            <span class="ml-2">Gérer les Tontines</span>
        </a>
        <div id="c" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Gestion des Tontines:</h6>
                <a class="collapse-item py-2" href="{{ route('tontines.index') }}">Liste des Tontines</a>
                <a class="collapse-item py-2" href="{{ route('tontines.create') }}">Créer une Tontine</a>
                <a class="collapse-item py-2" href="{{ route('images.create') }}">Insérer une image</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Participants -->
    <li class="nav-item">
        <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#participant">
            <i class="fas fa-user-friends fa-lg"></i>
            <span class="ml-2">Gérer les Participants</span>
        </a>
        <div id="participant" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Participants:</h6>
                <a class="collapse-item py-2" href="{{ route('participants.index') }}">Afficher les participants</a>
                <a class="collapse-item py-2" href="{{ route('admin.participants.create') }}">Enregistrer un participant</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Cotisations -->
    <li class="nav-item">
        <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#cotisation">
            <i class="fas fa-piggy-bank fa-lg"></i>
            <span class="ml-2">Gérer les Cotisations</span>
        </a>
        <div id="cotisation" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Cotisations:</h6>
                <a class="collapse-item py-2" href="{{ route('cotisations.index') }}">Cotisations Disponibles</a>
                <a class="collapse-item py-2" href="{{ route('cotisations.tontines.list') }}">Cotisations Tontines</a>
                <a class="collapse-item py-2" href="{{ route('cotisations.tontines2') }}">Cotisations Manquantes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tirage -->
    <li class="nav-item">
        <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#tirage">
            <i class="fas fa-dice fa-lg"></i>
            <span class="ml-2">Gérer Tirage</span>
        </a>
        <div id="tirage" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Tirage:</h6>
                <a class="collapse-item py-2" href="{{ route('tirages.form') }}">Effectuer un tirage</a>
                <a class="collapse-item py-2" href="{{ route('tirages.resultats') }}">Voir les résultats</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading text-uppercase text-white py-3 font-weight-bold">
        AUTRE
    </div>

    <!-- Nav Item - Autre -->
    <li class="nav-item active">
        <a class="nav-link py-3" href="{{ auth()->check() ? route('participant.tontines', auth()->user()->id) : 'page2.auth.auth' }}">
            <i class="fas fa-folder-open fa-lg"></i>
            <span class="ml-2">Autre Section</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
