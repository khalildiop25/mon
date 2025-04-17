<ul class="navbar-nav sidebar sidebar-dark accordion bg-gold" id="accordionSidebar">



    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SUNU KALPE</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <div class="sidebar-heading">
     ADMINISTRATEUR
    </div>

    <!-- Nav Item - Tontines -->
    <li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#c" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="fas fa-fw fa-users"></i>
        <span>Gérer les Tontines</span>
    </a>
    <div id="c" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des Tontines:</h6>
            <a class="collapse-item" href="{{ route('tontines.index') }}">Liste des Tontines</a>
            <a class="collapse-item" href="{{ route('tontines.create') }}">Créer une Tontine</a>
            <a class="collapse-item" href="{{ route('images.create') }}">insert image</a>
        </div>
    </div>
</li>


    
<!-- Nav Item - participant-->
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#participant" aria-expanded="true" 
        aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user-friends"></i>
        <span>Gérer les Participants</span>
        </a>
        <div id="participant" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('participants.index') }}">affiche participants</a>
                <a class="collapse-item" href="{{ route('admin.participants.create') }}">enregistrer participant</a>
                
            </div>
        </div>
    </li>

    <!-- Nav Item - cotisation -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cotisation"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Gérer les Cotisations</span>
    </a>
    <div id="cotisation" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="{{ route('cotisations.index') }}">Cotisations Disponibles</a>
            <a class="collapse-item" href="{{ route('cotisations.tontines.list') }}">Cotisations Tontines</a> <!-- Lien vers la liste des tontines -->
            <a class="collapse-item" href="{{ route('cotisations.tontines2') }}">Cotisations manquant</a> <!-- Lien vers la liste des tontines -->
        </div>
    </div>
</li>

<!-- Nav Item - tirage-->
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tirage" aria-expanded="true" 
        aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user-friends"></i>
        <span>Gérer Tirage</span>
        </a>
        <div id="tirage" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('tirages.form') }}">Effectuer un tirage</a>
                <a class="collapse-item" href="{{ route('tirage.effectuer') }}">ddddd</a> 
                <a class="collapse-item" href="{{ route('tirages.resultats') }}">Résultat tirage</a>
          
        </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        AUTRE
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
    <a class="nav-link" href="{{ auth()->check() ? route('participant.tontines', auth()->user()->id) : 'page2.auth.auth' }}" >
        <i class="fas fa-fw fa-folder"></i>
        <span>aaaaaa</span>
    </a>
</li>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>bbbbb</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>ccccccccc</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
