@extends('app')

@section('content')
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

<div class="container">
    <h2>Ajouter une image à une Tontine</h2>

    @foreach($tontines as $tontine)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $tontine->libelle }}</h5>
                <p class="card-text">{{ $tontine->description }}</p>
                <p><strong>Fréquence :</strong> {{ $tontine->frequence }}</p>

                <!-- Formulaire d'ajout d'image -->
                <form action="{{ route('images.store', $tontine->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Choisir une image</label>
                        <input type="file" name="image" id="image" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Uploader l'image</button>
                </form>

                <!-- Lien pour voir les images de la tontine -->
                <a href="{{ route('images.index', $tontine->id) }}" class="btn btn-info mt-2">Voir image(s)</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
