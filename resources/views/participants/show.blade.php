@extends('app')

@section('content')
<div class="container">
     <!-- Affichage du message de succès, s'il y en a un -->
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Details du Participant</h1>

   

    <div class="card">
        <div class="card-header">
            Informations du Participant
        </div>
        <div class="card-body">
            <p><strong>Nom d'utilisateur:</strong> {{ $participant->user->nom }}</p>
            <p><strong>Date de naissance:</strong> {{ \Carbon\Carbon::parse($participant->dateNaissance)->format('d/m/Y') }}</p>
            <p><strong>CNI:</strong> {{ $participant->cni }}</p>
            <p><strong>Adresse:</strong> {{ $participant->adresse }}</p>
            
            @if($participant->imageCni)
                <p><strong>Image de la CNI:</strong></p>
                <img src="{{ asset('storage/cni_images/' . $participant->imageCni) }}" alt="Image de la CNI" class="img-fluid" width="200">
            @else
                <p>Aucune image de CNI disponible.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>

    <br>
    <a href="{{ route('participants.index') }}" class="btn btn-secondary">Retour à la liste des participants</a>
</div>
@endsection
