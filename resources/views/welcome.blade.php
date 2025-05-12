@extends('app')

@section('content')
    <div class="container-fluid">


        <!-- Vérification si l'utilisateur est connecté -->
        @if (Auth::check())
            <!-- Vérification du rôle de l'utilisateur -->
            @if (Auth::user()->profil == 'GERANT')
                <!-- Affichage du nom, prénom et imageCni pour le GERANT -->
                <div class="alert alert-success">
                    <div class="row align-items-center">
                        <!-- Image CNI à gauche -->
                        <div class="col-md-3">
                            @if (Auth::user()->participant && Auth::user()->participant->imageCni)
                                <img src="{{ asset('storage/' . Auth::user()->participant->imageCni) }}" alt="Image CNI"
                                    class="img-fluid w-100" style="max-width: 200px; border-radius: 8px;">
                            @else
                                <p class="text-muted">Aucune image CNI disponible.</p>
                            @endif

                        </div>
                        <!-- Texte à droite -->
                        <div class="col-md-9">
                            <h3 class="display-3">Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }} !</h3>
                            <p class="fs-1">
                                Bienvenue sur votre espace de gestion des tontines. Vous avez accès à toutes les
                                fonctionnalités administratives pour gérer les tontines, les participants et plus encore.
                            </p>
                            <p class="fs-4">
                                Votre rôle de Gérant vous permet de superviser, organiser et gérer l'ensemble des activités
                                liées aux tontines. Assurez-vous que tout fonctionne correctement et que les participants
                                puissent suivre leurs cotisations.
                            </p>
                        </div>
                    </div>
                </div>
    </div>
@elseif(Auth::user()->profil == 'PARTICIPANT' && Auth::user()->participant)
    <div class="container py-5" style="background-color:#cddcf4;">
        <!-- En-tête principal -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">🎉 Bienvenue sur Sunu Kalpe !</h1>
            <p class="fs-5 text-muted">L’univers des tontines simplifié rien que pour vous.</p>
        </div>

        <!-- Carte de bienvenue -->
        <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-center">
                <!-- Image -->
                <div class="col-md-6">
                    <img src="{{ asset('images/part3.jpg') }}" alt="Bienvenue" class="img-fluid rounded-start w-100 h-100"
                        style="object-fit: cover;">
                </div>

                <!-- Message -->
                <div class="col-md-6 p-5">
                    <h2 class="fw-bold mb-3">Bonjour, {{ Auth::user()->participant->prenom }}
                        {{ Auth::user()->participant->nom }} 👋</h2>
                    <p class="fs-5">
                        Bienvenue dans votre espace personnel. Ici, vous pouvez :
                    <ul class="fs-6">
                        <li>📌 Suivre vos cotisations</li>
                        <li>👥 Voir vos tontines actives</li>
                        <li>🎯 Participer aux tirages</li>
                        <li>📈 Suivre votre progression financière</li>
                    </ul>
                    </p>
                    <a href="{{ route('participant.tontines', auth()->user()->participant->id) }}"
                        class="btn btn-primary btn-lg mt-3">
                        Accéder à mes tontines
                    </a>
                </div>
            </div>
        </div>
    </div>






    @include('tontines.partnostont')

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
    @endif
    <!--</div>-->
@else
    <section class="relative flex items-center justify-center text-white text-center py-20"
        style="background: linear-gradient(135deg, rgba(26, 54, 93, 0.8), rgba(45, 55, 72, 0.8)),
                url('{{ asset('images/imgAccueil.jpg') }}') center center / contain no-repeat; min-height: 50vh;">
        <div class="z-10 max-w-3xl px-6">
            <h1 class="text-5xl font-bold mb-4">Épargnez, investissez, grandissez ensemble.</h1>
            <p class="text-xl mb-6">Rejoignez une communauté financière solidaire et atteignez vos objectifs grâce à la
                tontine moderne et digitale.</p>
            {{-- <a href="{{ route('inscription.index') }}" class="bg-white text-blue-700 hover:bg-blue-800 hover:text-white py-3 px-6 rounded-full font-semibold transition">Rejoindre une tontine</a> --}}
            <a href="{{ route('tontines.nostontines') }}"
                class="text-white py-3 px-6 rounded-full font-semibold transition no-underline hover:no-underline"
                style="background-color: #E67E22;" onmouseover="this.style.backgroundColor='#c59d5f'"
                onmouseout="this.style.backgroundColor='#E67E22'">
                Rejoindre une tontine
            </a>



        </div>
    </section>



    <!-- Comment ça fonctionne -->

    <section class="how-it-works py-12 bg-gray-50">
        {{-- <h2 class="text-3xl font-bold text-center mb-8">Comment ça fonctionne ?</h2> --}}
        <div style="text-align: center;">
            <h2 class="titre-souligne ">Comment ça fonctionne ?</h2>
        </div>



        <div class="steps-grid grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">

            <div class="step-card p-6 bg-white rounded-lg shadow-md text-center transition duration-300">
                <div class="step-icon text-4xl text-orange-500 mb-4">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">1. Inscription</h3>
                <p>Créez votre compte en quelques clics et complétez votre profil.</p>
            </div>

            <div class="step-card p-6 bg-white rounded-lg shadow-md text-center transition duration-300">
                <div class="step-icon text-4xl text-orange-500 mb-4">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">2. Contribution</h3>
                <p>Participez régulièrement selon les modalités choisies.</p>
            </div>

            <div class="step-card p-6 bg-white rounded-lg shadow-md text-center transition duration-300">
                <div class="step-icon text-4xl text-orange-500 mb-4">
                    <i class="fas fa-gift"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">3. Réception</h3>
                <p>Recevez votre part à la période définie dans le groupe.</p>
            </div>

        </div>

    </section>


    {{-- </section> --}}


    <!-- Avantages -->
    <section class="benefits">

        <div style="text-align: center;">
            <h2 class="titre-souligne">Pourquoi choisir notre plateforme ?</h2>
        </div>
        <p class="section-subtitle">Nous réinventons la tontine avec des outils digitaux, de la transparence et une
            flexibilité totale.</p>
        <div class="benefits-grid">
            <div class="benefit-card">
                <h3>Sécurisée</h3>
                <p>Toutes les transactions sont cryptées et protégées.</p>
            </div>
            <div class="benefit-card">
                <h3>Flexible</h3>
                <p>Choisissez la durée, la fréquence et le montant qui vous convient.</p>
            </div>
            <div class="benefit-card">
                <h3>Communautaire</h3>
                <p>Rejoignez un réseau de membres fiables et engagés.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <h2>Prêt à commencer votre aventure financière ?</h2>
        <p>Inscrivez-vous dès aujourd'hui et rejoignez des milliers d'utilisateurs satisfaits.</p>
        {{-- <button class="cta-button">Créer un compte</button> --}}
        <button class="cta-button" onclick="window.location.href='{{ route('inscription.index') }}'">Créer un
            compte</button>

    </section>



    @endif
   <!-- </div>-->
@endsection
