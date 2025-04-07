@extends('app')

@section('content')
    <h1>Détails de l'Image</h1>
    <p><strong>Nom de l'image:</strong> {{ $image->nomImage }}</p>
    <p><strong>Tontine associée:</strong> {{ $image->tontine->name }}</p>
    <a href="{{ route('images.index') }}">Retour à la liste</a>
@endsection