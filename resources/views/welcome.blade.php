@extends('app')

@section('content')
<div class="container-fluid">
<div class="container-fluid bg-gradient-primary text-white py-2">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="display-4 font-weight-bold">
                <span class="text-warning">Bienvenue sur</span> <span class="text-light">Sunu Tontine</span>
            </h1>
            <p class="lead text-light mb-4">
                La plateforme idéale pour gérer vos tontines en toute sécurité et transparence. Rejoignez-nous et découvrez comment faciliter la gestion de vos cotisations, prêts, et bien plus encore.
            </p>
          
        </div>
    </div>
</div>


    @if(Auth::check())
        @if(Auth::user()->profil == 'GERANT')
            <div class="alert alert-success shadow-sm rounded-lg mb-4" style="border-left: 5px solid #f8b800;">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        @if(Auth::user()->participant && Auth::user()->participant->imageCni)
                            <img src="{{ asset('storage/' . Auth::user()->participant->imageCni) }}" alt="Image CNI" class="img-fluid w-100" style="max-width: 200px; border-radius: 8px;">
                        @else
                            <p class="text-muted">Aucune image CNI disponible.</p>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h3 class="display-3 font-weight-bold text-dark mb-4" style="letter-spacing: 2px;">Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }} !</h3>
                        <p class="fs-1">
                            Bienvenue sur votre espace de gestion des tontines. Vous avez accès à toutes les fonctionnalités administratives pour gérer les tontines, les participants et plus encore.
                        </p>
                        <p class="fs-4">
                            Votre rôle de Gérant vous permet de superviser, organiser et gérer l'ensemble des activités liées aux tontines. Assurez-vous que tout fonctionne correctement et que les participants puissent suivre leurs cotisations.
                        </p>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->profil == 'PARTICIPANT')
            <div class="alert alert-info text-center shadow-sm rounded-lg mb-4" style="border-left: 5px solid #f8b800;">
                <p class="fs-1">Bienvenue dans votre espace participant. Vous pouvez consulter vos tontines en cours, suivre vos cotisations et plus encore.</p>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <img src="{{ asset('images/accueil.jpg') }}" alt="Image d'accueil" class="img-fluid rounded shadow-lg" style="max-height: 500px; object-fit: cover;">
                </div>
                <div class="col-md-6">
                <h1 class="display-6 text-primary font-weight-bold">
                Bienvenue sur votre espace personnel,
Gérez vos tontines facilement et en toute sécurité.
Félicitations, vous êtes désormais connecté à votre compte Sunu Tontine !
 Vous avez accès à toutes les fonctionnalités qui vous permettent de gérer vos tontines en toute simplicité.

                </div>
            </div>

           <div class="mt-5"> 
    <h2 class="text-center display-3 text-secondary mb-4">Toutes nos Tontines</h2>

    @if($tontines->isEmpty())
        <p class="text-center fs-3">Aucune tontine n'est disponible pour l'instant.</p>
    @else
        <div class="row">
            @foreach($tontines as $index => $tontine)
                @if($index % 3 == 0 && $index != 0)
                    </div><div class="row">
                @endif
                <div class="col-md-4 mb-4 fade-in ">
                    <div class="card h-100 shadow-sm rounded-lg border-0">
                        @php
                            $imageSrc = $tontine->images->isNotEmpty() 
                                ? asset('storage/' . $tontine->images->first()->nomImage)
                                : asset('images/default-tontine.jpg');
                        @endphp

                        <img src="{{ $imageSrc }}" 
                             class="card-img-top rounded-top object-cover" 
                             alt="Image de la tontine"
                             style="height: 200px; width: 100%; cursor: pointer;" 
                             onclick="openModal('{{ $imageSrc }}')">

                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">{{ $tontine->libelle }}</h5>
                            <a href="{{ route('tontines.show', $tontine->id) }}" class="btn bg-gold text-white w-100 rounded-pill shadow-sm hover-shadow">Voir la Tontine</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Lightbox Modal -->
<!-- Lightbox Modal -->
<div id="lightboxModal"
     style="position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.8);
            display: none; justify-content: center; align-items: center;
            z-index: 9999;">
    
    <img id="modalImage"
         src=""
         style="max-width: 90vw; max-height: 90vh; border-radius: 10px; box-shadow: 0 0 15px #000;">
    
    <!-- Bouton pour fermer -->
    <span onclick="closeModal()"
          style="position: absolute; top: 20px; right: 30px;
                 font-size: 30px; color: white; cursor: pointer; font-weight: bold;">×</span>
</div>


<script>
    function openModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('lightboxModal').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Bloque le scroll
    }

    function closeModal() {
        document.getElementById('lightboxModal').style.display = 'none';
        document.getElementById('modalImage').src = '';
        document.body.style.overflow = 'auto'; // Restaure le scroll
    }
</script>


        @endif
    @else
        <div class="alert alert-info text-center shadow-sm rounded-lg mb-4" style="border-left: 5px solid #f8b800;">
            
            <p class="fs-1">Bienvenue dans votre espace participant. Vous pouvez consulter les tontines disponibles et plus encore.</p>
        </div>
        
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="{{ asset('images/accueil.jpg') }}" alt="Image d'accueil" class="img-fluid rounded shadow-lg" style="max-height: 500px; object-fit: cover;">
            </div>
            <div class="col-md-6">
            <h1 class=" display-6 text-warning">
            🏡 Bienvenue sur Sunu Tontine.
Une plateforme dédiée à la gestion des tontines, permettant aux utilisateurs d’organiser et de suivre leurs cotisations, prêts, et bien plus encore, de manière simple et intuitive.
 Que vous soyez à la recherche d’une tontine existante ou que vous souhaitiez en savoir plus sur notre service, vous êtes au bon endroit.
</h1>

            </div>
        </div>

        <div class="mt-5"> 
    <h2 class="text-center display-3 text-secondary mb-4">Toutes nos Tontines</h2>

    @if($tontines->isEmpty())
        <p class="text-center fs-3">Aucune tontine n'est disponible pour l'instant.</p>
    @else
        <div class="row">
            @foreach($tontines as $index => $tontine)
                @if($index % 3 == 0 && $index != 0)
                    </div><div class="row">
                @endif
                <div class="col-md-4 mb-4 fade-in ">
                    <div class="card h-100 shadow-sm rounded-lg border-0">
                        @php
                            $imageSrc = $tontine->images->isNotEmpty() 
                                ? asset('storage/' . $tontine->images->first()->nomImage)
                                : asset('images/default-tontine.jpg');
                        @endphp

                        <img src="{{ $imageSrc }}" 
                             class="card-img-top rounded-top object-cover" 
                             alt="Image de la tontine"
                             style="height: 200px; width: 100%; cursor: pointer;" 
                             onclick="openModal('{{ $imageSrc }}')">

                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">{{ $tontine->libelle }}</h5>
                            <a href="{{ route('tontines.show', $tontine->id) }}" class="btn bg-gold text-white w-100 rounded-pill shadow-sm hover-shadow">Voir la Tontine</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Lightbox Modal -->
<!-- Lightbox Modal -->
<div id="lightboxModal"
     style="position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.8);
            display: none; justify-content: center; align-items: center;
            z-index: 9999;">
    
    <img id="modalImage"
         src=""
         style="max-width: 90vw; max-height: 90vh; border-radius: 10px; box-shadow: 0 0 15px #000;">
    
    <!-- Bouton pour fermer -->
    <span onclick="closeModal()"
          style="position: absolute; top: 20px; right: 30px;
                 font-size: 30px; color: white; cursor: pointer; font-weight: bold;">×</span>
</div>


<script>
    function openModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('lightboxModal').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Bloque le scroll
    }

    function closeModal() {
        document.getElementById('lightboxModal').style.display = 'none';
        document.getElementById('modalImage').src = '';
        document.body.style.overflow = 'auto'; // Restaure le scroll
    }
</script>
    @endif
</div>
@endsection
