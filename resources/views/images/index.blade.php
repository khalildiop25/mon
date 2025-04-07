@extends('app')

@section('content')
    <h1>Liste des Images</h1>
    <a href="{{ route('images.create') }}">Ajouter une image</a>
    <ul>
        @foreach ($images as $image)
            <li>{{ $image->nomImage }} 
                <a href="{{ route('images.show', $image->id) }}">Voir</a> 
                <form action="{{ route('images.destroy', $image->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection