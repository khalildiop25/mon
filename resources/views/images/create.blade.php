@extends('app')

@section('content')
<div class="container mt-4">
    {{-- Messages de succès/erreur --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-gold mb-0">
        <i class="fas fa-image mr-2"></i>Ajouter une image à une Tontine
    </h2>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Retour
    </a>
</div>


    @foreach($tontines as $tontine)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $tontine->libelle }}</h5>
                <p class="card-text">{{ $tontine->description }}</p>
                <p><strong>Fréquence :</strong> {{ $tontine->frequence }}</p>

                <!-- Formulaire d'ajout d'image -->
                <form action="{{ route('images.store', $tontine->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image" class="form-label">Choisir une image</label>
                        <input type="file" name="image" id="image" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-warning text-white mt-2">Uploader l'image</button>
                </form>

                <!-- Lien pour voir les images de la tontine -->
                <a href="{{ route('images.index', $tontine->id) }}" class="btn btn-info mt-2">Voir image(s)</a>
            </div>
        </div>
    @endforeach
</div>

{{-- Styles personnalisés --}}
<style>
    .text-gold {
        color: #DAA520;
    }
    .btn-warning {
        background-color: #DAA520;
        border-color: #DAA520;
    }
    .btn-warning:hover {
        background-color: #c59c1c;
        border-color: #c59c1c;
    }
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    .btn-info:hover {
        background-color: #138496;
        border-color: #138496;
    }
</style>

@endsection
