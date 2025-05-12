

@if(Auth::check())
<!--@php
    $profil = strtoupper(Auth::user()->profil);
    $footerStyle = ($profil === 'PARTICIPANT')
        ? 'background-color:#c59d5f !important; position: absolute; bottom: 0; width: 100%; padding: 10px 0; text-align: center;'
        : 'background-color:#c59d5f !important;';
@endphp

<footer style="{{ $footerStyle }}">
    <p>
        &copy; {{ date('Y') }} | Tous droits réservés | <span class="font-semibold">Sunu Kalpe</span>
    </p>
</footer>-->
@if( Auth::user()->profil == 'GERANT')
<footer style="background-color:#c59d5f !important;">
    <p>
        &copy; {{ date('Y') }} | Tous droits réservés | <span class="font-semibold">Sunu Kalpe</span>
    </p>
</footer>

@elseif(Auth::user()->profil == 'PARTICIPANT')
<footer style="background-color:#c59d5f !important; position: absolute; bottom: 0; width: 100%; padding: 10px 0; text-align: center;">
    <p>
        &copy; {{ date('Y') }} | Tous droits réservés | <span class="font-semibold">Sunu Kalpe</span>
    </p>
</footer>

@endif

@else

<footer class="py-3 text-white text-sm" style="background-color: #162c4a;">
    <div class="container mx-auto">
        <!-- Logo + témoignages -->
        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6">
            <!--LOGO À GAUCHE -->
            <div class="mb-4 md:mb-0">
                <img src="{{ asset('images/logo.jpg') }}" style="background-color: #162c4a;" alt="Logo" class="h-12">
            </div>

           <!-- SECTION TÉMOIGNAGES -->
<div class="w-full md:w-10/12 text-center md:text-left">
    <h2 class="text-2xl font-bold mb-4 text-white">Ils témoignent</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            [
                'text' => 'Grâce à cette tontine, j\'ai pu réaliser mon projet immobilier. Je recommande vivement !',
                'author' => 'Aminata, 35 ans',
                'rating' => 3
            ],
            [
                'text' => 'Un système simple et efficace pour épargner en groupe. Je suis très satisfait.',
                'author' => 'Mouhamed, 42 ans',
                'rating' => 5
            ],
            [
                'text' => 'Je participe à plusieurs tontines via cette plateforme et tout est bien géré.',
                'author' => 'Fatou, 29 ans',
                'rating' => 4
            ]
        ] as $testimonial)
            <div class="p-4 bg-white rounded-lg shadow-md text-gray-800 text-left transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <p class="italic text-sm">"{{ $testimonial['text'] }}"</p>
                <p class="mt-2 font-medium text-gray-600">- {{ $testimonial['author'] }}</p>

                {{-- Étoiles de notation --}}
                <div class="flex items-center mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $testimonial['rating'])
                            <i class="bi bi-star-fill text-yellow-400 mr-1"></i>
                        @else
                            <i class="bi bi-star text-yellow-400 mr-1"></i>
                        @endif
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
</div>

        </div>

        {{-- Liens de navigation --}}
        <div class="mb-4 text-xs text-center">
            <a href="{{ route('home') }}" class="mx-2 text-gray-400 hover:text-orange transition">Accueil</a>
            <a href="{{route('tontines.nostontines')}}" class="mx-2 text-gray-400 hover:text-blue-400 transition">Tontines</a>
            <a href="{{ route('contact') }}" class="mx-2 text-gray-400 hover:text-blue-400 transition">Contact</a>
            <a href="{{ route('bouton.apropos') }}" class="mx-2 text-gray-400 hover:text-blue-400 transition">À propos</a>
        </div>


        <div class="flex flex-col md:flex-row justify-between text-center gap-6 mb-3">
            <!-- Nos Services -->
            <div class="w-full md:w-1/3">
                <h3 class="text-lg font-semibold mb-2">Nos Services</h3>
                <ul class="space-y-1 text-gray-300 text-sm">
                    <li><a href="#">Devenir Membre</a></li>
                    <li><a href="#">Nos Offres de Tontine</a></li>
                    <li><a href="#">Comparer les Offres</a></li>
                    <li><a href="#">Tontine Solidaire</a></li>
                    <li><a href="#">Épargne Collective</a></li>
                    <li><a href="#">Nos Partenaires Financiers</a></li>
                    <li><a href="#">Actualités Tontine</a></li>
                    <li><a href="#">FAQ - Questions Fréquentes</a></li>
                </ul>
            </div>

            <!-- Informations Légales -->
            <div class="w-full md:w-1/3">
                <h3 class="text-lg font-semibold mb-2">Informations Légales</h3>
                <ul class="space-y-1 text-gray-300 text-sm">
                    <li><a href="#">Termes & Conditions</a></li>
                    <li><a href="#">Mentions Légales</a></li>
                    <li><a href="#">Politique de Confidentialité</a></li>
                    <li><a href="#">Conditions Générales d'Utilisation</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>

            <!-- Suivez-nous -->
            <div class="w-full md:w-1/3">
                <h3 class="text-lg font-semibold mb-2">Suivez-nous</h3>
                <ul class="space-y-1 text-gray-300 text-sm">
                    <li><a href="#"><i class="fab fa-instagram mr-2"></i>Instagram</a></li>
                    <li><a href="#"><i class="fab fa-tiktok mr-2"></i>TikTok</a></li>
                    <li><a href="#"><i class="fab fa-twitter mr-2"></i>Twitter</a></li>
                </ul>
            </div>
        </div>
<hr/>
      
        <div class="text-gray-400 text-xs text-center" >
            &copy; {{ date('Y') }} | Tous droits réservés | <span class="font-semibold">Sunu Kalpe</span>
        </div>
    </div>
    @endif
</footer>
