<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Navbar Links -->
        <ul class="navbar-nav ml-auto">

            <!-- Check if the user is not authenticated -->
            @guest
                <!-- If user is not authenticated, show Login and Register links -->
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
                <!-- If user is authenticated, show links for authenticated users -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('participant.tontines', auth()->user()->participant->id) }}">
                        <i class="fas fa-users fa-fw"></i> Mes tontines
                    </a>
                </li>
                
                <!-- New Links for Cotisation, Tirage, Notifications -->
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
                    <a class="nav-link" href="{{ route('tirages.user', auth()->user()->id) }}">
                        <i class="fas fa-cogs fa-fw"></i> Participer au tirage
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notifications.index') }}">
                        <i class="fas fa-bell fa-fw"></i> Notifications
                    </a>
                </li>

                <!-- Dropdown - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nom }}</span>
                        <img class="img-profile rounded-circle" src="{{ asset('storage/' . Auth::user()->participant->imageCni) }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profil
                        </a>
                        <a class="dropdown-item" href="{{ route('settings') }}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Paramètres
                        </a>
                        <div class="dropdown-divider"></div>

                        <!-- Déconnexion -->
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Déconnexion
                        </a>
                    </div>
                </li>

                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </div>
</nav>
