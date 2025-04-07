@extends('app')

@section('content')
    <div class="container">
        @if(isset($user))
            <h1>Tirages de l'utilisateur : {{ $user->name }}</h1>
        @elseif(isset($tontine))
            <h1>Tirages de la tontine : {{ $tontine->libelle }}</h1>
        @endif

        <!-- Message de succès, si applicable -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table des tirages -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Tontine</th>
                    <th>Date du tirage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tirages as $tirage)
                    <tr>
                        <td>{{ $tirage->user->name }}</td>
                        <td>{{ $tirage->tontine->libelle }}</td>
                        <td>{{ $tirage->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Ajouter un tirage -->
        <a href="{{ route('tirages.create') }}" class="btn btn-primary">Ajouter un tirage</a>
    </div>
@endsection
