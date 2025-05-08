@extends('app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white text-center">
            <h3 class="mb-0">Effectuer un Tirage</h3>
        </div>

        <div class="card-body">
            <!-- Affichage des messages -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Formulaire de tirage -->
            <form action="{{ route('tirage.effectuer') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tontine_id" class="font-weight-bold">Sélectionnez une tontine :</label>
                    <select name="tontine_id" id="tontine_id" class="form-control" required>
                        <option value="">-- Choisir une tontine --</option>
                        @foreach($tontines as $tontine)
                            <option value="{{ $tontine->id }}">{{ $tontine->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn bg-gold text-white px-4 py-2">🎲 Tirer au sort</button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">Retour</a>
</div>

@endsection
