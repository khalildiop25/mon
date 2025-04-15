@extends('app')

@section('content')
<div class="container">
    <h2>Effectuer un tirage</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tirage.effectuer') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tontine_id">Sélectionnez une tontine :</label>
            <select name="tontine_id" id="tontine_id" class="form-control" required>
                <option value="">-- Choisir une tontine --</option>
                @foreach($tontines as $tontine)
                    <option value="{{ $tontine->id }}">{{ $tontine->libelle }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Tirer au sort</button>
    </form>
</div>
@endsection
