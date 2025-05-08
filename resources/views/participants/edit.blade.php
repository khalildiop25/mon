@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{ url()->previous() }}" class="btn btn-gold bg-gold text-gold float-right mb-3">Retour</a>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow rounded">
        <div class="card-body">
          <h3 class="card-title mb-4">Modifier Participant</h3>
          <form action="{{ route('participants.update', $participant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nom">Nom</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $participant->user->nom) }}" readonly>
                  @error('nom')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="date_naissance">Date de naissance</label>
                  <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $participant->date_naissance) }}">
                  @error('date_naissance')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="cni">CNI</label>
                  <input type="text" class="form-control" id="cni" name="cni" value="{{ old('cni', $participant->cni) }}">
                  @error('cni')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="adresse">Adresse</label>
                  <textarea class="form-control" id="adresse" name="adresse" rows="3">{{ old('adresse', $participant->adresse) }}</textarea>
                  @error('adresse')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="cni_image">Image de la CNI</label>
                  <input type="file" class="form-control-file" id="cni_image" name="cni_image">
                  @error('cni_image')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="role">Rôle</label>
                  <input type="text" class="form-control" id="role" name="role" value="{{ old('role', $participant->role) }}">
                  @error('role')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-gold bg-gold text-gold">Mettre à jour</button>
              <button type="reset" class="btn btn-gold bg-gold text-gold ml-2">Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
