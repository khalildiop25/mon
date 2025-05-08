@extends('app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-gold">Détails du Participant</h2>
        <a href="{{ route('participants.index') }}" class="btn btn-gold">
            <i class="fas fa-arrow-left me-2"></i> Retour
        </a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow-sm border border-2" style="border-color: #DAA520; border-radius: 12px;">
        <div class="card-header text-white" style="background-color: #DAA520; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <strong>Informations du Participant</strong>
        </div>
        <div class="card-body">
            <p><strong>Nom d'utilisateur :</strong> {{ $participant->user->nom }}</p>
            <p><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($participant->dateNaissance)->format('d/m/Y') }}</p>
            <p><strong>CNI :</strong> {{ $participant->cni }}</p>
            <p><strong>Adresse :</strong> {{ $participant->adresse }}</p>

            @if($participant->imageCni)
                <div class="mt-3">
                    <p><strong>Image de la CNI :</strong></p>
                    <img src="{{ asset('storage/cni_images/' . $participant->imageCni) }}" alt="Image de la CNI" class="img-thumbnail" style="max-width: 250px;">
                </div>
            @else
                <p class="text-muted">Aucune image de CNI disponible.</p>
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ url()->previous(), $participant->id }}" class="btn btn-gold">
                <i class="fas fa-edit me-1"></i> Modifier
            </a>
        </div>
    </div>
</div>
@endsection
