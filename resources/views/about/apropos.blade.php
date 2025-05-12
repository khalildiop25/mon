
@extends('app')

@section('content')
<style>
    #div{background-color: #f3e8d2}
    .section-apropos {
        max-width: 960px;
        margin: 0 auto;
    }
    .carte-valeur {
        background: linear-gradient(to bottom, #fffaf4, #fff);
        border: 1px solid #f3e8d2;
        border-left: 6px solid #e67e22;
        box-shadow: 0 3px 6px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    .carte-valeur:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
    }
    .citation-box {
        background-color: #fdf4e3;
        border-left: 4px solid #e67e22;
        color: #a05c11;
    }
</style>

<div id="div" class="bg-gradient-to-br from-orange-50 via-white to-white py-14 px-4 md:px-8">
    <div class="section-apropos text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-amber-700 mb-6">
            À propos de <span class="text-gray-900">Sunu Kalpe</span>
        </h1>

        <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-12">
            La <span class="text-amber-600 font-semibold">tontine</span> est une institution précieuse héritée de nos parents.
            <br><br>
            Avec <strong>Sunu Kalpe</strong>, nous avons digitalisé cette pratique afin de la rendre plus accessible, sécurisée et moderne, tout en préservant son esprit solidaire.
        </p>

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Nos valeurs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
            @foreach([
                ['title' => 'Solidarité', 'desc' => 'La confiance est au cœur de nos communautés.'],
                ['title' => 'Accessibilité', 'desc' => 'Un outil simple, même pour les non-initiés.'],
                ['title' => 'Innovation', 'desc' => 'Une tradition portée par la technologie.'],
                ['title' => 'Transparence', 'desc' => 'Clarté et fiabilité dans la gestion des fonds.'],
                ['title' => 'Respect culturel', 'desc' => 'Préserver l’esprit tout en modernisant.'],
                ['title' => 'Confiance', 'desc' => 'Sécurité dans chaque interaction.']
            ] as $valeur)
                <div class="carte-valeur rounded-md p-4">
                    <h3 class="text-lg font-semibold text-amber-800 mb-1">{{ $valeur['title'] }}</h3>
                    <p class="text-sm text-gray-700">{{ $valeur['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="citation-box mt-12 p-6 rounded text-center max-w-2xl mx-auto">
            <p class="italic text-base font-medium">
                « Ensemble, nous réinventons la solidarité traditionnelle avec les outils d'aujourd'hui. »
            </p>
        </div>
    </div>
</div>
@endsection
