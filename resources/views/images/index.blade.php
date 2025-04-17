@extends('app')

@section('content')
<div class="container">
    <h2 class="mb-4">Images de la Tontine : <strong>{{ $tontine->libelle }}</strong></h2>

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

    @if($images->isEmpty())
        <p>Aucune image enregistrée pour cette tontine.</p>
    @else
        <div class="row">
            @foreach($images as $image)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('storage/' . $image->nomImage) }}" class="card-img-top" alt="Image" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text text-center">{{ basename($image->nomImage) }}</p>

                            <!-- Formulaire de suppression -->
                            <form action="{{ route('images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de cette image ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Bouton retour -->
    <a href="{{ route('images.create') }}" class="btn btn-secondary mt-3">← Retour</a>
</div>
@endsection
