<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow navbar-gold">

    <div class="container">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Navbar Links -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-home fa-fw"></i> Accueil
          </a>
        </li>

    @guest
        <!-- Liens pour les invités -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('auth.create') }}">
                <i class="fas fa-user-circle fa-fw"></i> Se connecter
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('inscription.index') }}">
                <i class="fas fa-user-plus fa-fw"></i> S'inscrire
            </a>
        </li>

    @else
        @if(Auth::user()->profil == 'PARTICIPANT')
            <!-- Liens spécifiques au participant -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('participant.tontines', auth()->user()->participant->id) }}">
                    <i class="fas fa-users fa-fw"></i> Mes tontines
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cotisations.Participant', auth()->user()->id) }}">
                    <i class="fas fa-credit-card fa-fw"></i> Effectuer une cotisation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cotisations.user', auth()->user()->id) }}">
                    <i class="fas fa-list fa-fw"></i> Voir l'état de ma cotisation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tirage.form', auth()->user()->id) }}">
                    <i class="fas fa-cogs fa-fw"></i> Participer au tirage
                </a>
            </li>

            <!-- Notifications -->
            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i> Notifications

        {{-- Badge rouge si l’utilisateur a des notifications non lues --}}
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger badge-counter">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        {{-- Boucle sur les notifications non lues --}}
        @forelse(auth()->user()->unreadNotifications as $notification)
            {{-- Chaque notification mène vers une route qui la marque comme lue --}}
            <a class="dropdown-item" href="{{ route('notifications.read', $notification->id) }}">
                {{ $notification->data['message'] }}
            </a>
        @empty
            {{-- Message si aucune notification non lue --}}
            <span class="dropdown-item text-muted">Aucune nouvelle notification</span>
        @endforelse
    </div>
</li>

        @endif

        <!-- Menu utilisateur pour TOUS les utilisateurs connectés -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nom }}</span>
                <img class="img-profile rounded-circle" 
                     src="{{ Auth::user()->participant && Auth::user()->participant->imageCni 
                            ? asset('storage/' . Auth::user()->participant->imageCni) 
                            : asset('images/default-user.png') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profil
                </a>
                <a class="dropdown-item" href="{{ route('settings') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Paramètres
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Déconnexion
                </a>
            </div>
        </li>

        <!-- Formulaire de déconnexion -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest

</ul>

    </div>
</nav>
