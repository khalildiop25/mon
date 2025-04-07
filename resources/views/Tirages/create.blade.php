@extends('app')

@section('content')
    <div class="container">
        <h1>Enregistrer un tirage</h1>

        <!-- Formulaire d'ajout de tirage -->
        <form action="{{ route('tirages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="idUser">Utilisateur</label>
                <select name="idUser" id="idUser" class="form-control" required>
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idTontine">Tontine</label>
                <select name="idTontine" id="idTontine" class="form-control" required>
                    <option value="">Sélectionner une tontine</option>
                    @foreach($tontines as $tontine)
                        <option value="{{ $tontine->id }}">{{ $tontine->libelle }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer le tirage</button>
        </form>
    </div>
@endsection
