<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow navbar-gold">
 <!-- 🔽 Ajoute ton logo ici, à gauche -->

 <!-- Vérification du rôle de l'utilisateur -->

@auth
    @if(auth()->user()->profil !== 'GERANT')
        <a class="navbar-brand d-flex align-items-center ml-3" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 50px;">
        </a>
    @endif
@else

        <a class="navbar-brand d-flex align-items-center ml-3" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 50px;">
        </a>

@endauth



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
          @guest
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('bouton.apropos') }}">
                <i class="fas fa-info-circle"></i> <span>À propos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('tontines.nostontines')}}">

                <i class="fas fa-piggy-bank"></i> <span>Nos tontines</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">
                <i class="fas fa-phone"></i> <span>Nous contacter</span>
            </a>
        </li>


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


        @if(Auth::user()->profil === 'PARTICIPANT')
       @include('layouts.navbarPart')
@endif


        <!-- Menu utilisateur pour TOUS les utilisateurs connectés -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-black-600 small"><strong>{{ Auth::user()->nom }}</strong></span>
                <img class="img-profile rounded-circle"
                     src="{{ Auth::user()->participant && Auth::user()->participant->imageCni
                            ? asset('storage/' . Auth::user()->participant->imageCni)
                            : asset('images/default-user.jpg') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i> <b>Profil</b>
                </a>
                <a class="dropdown-item" href="{{ route('settings') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-black-400"></i> <b>Paramètres</b>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i> <b>Déconnexion</b>
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
