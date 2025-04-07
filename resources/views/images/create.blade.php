@extends('app')

@section('content')
    <h1>Ajouter une image à la tontine {{ $tontine->libelle }}</h1>

    <form action="{{ route('images.store', $tontine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Choisir une image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Télécharger</button>
    </form>
@endsection