@extends('app')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
            <div class="card-header" style="background-color: #DAA520 ; color: black;">

                    <h5 class="mb-0"><i class="fas fa-user-edit mr-2"></i>Modifier mon profil</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('set') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-3">
                            <label for="prenom" class="col-md-4 col-form-label text-md-right">Prénom</label>
                            <div class="col-md-8">
                                <input type="text" name="prenom" id="prenom"
                                    class="form-control @error('prenom') is-invalid @enderror"
                                    value="{{ old('prenom', Auth::user()->prenom) }}" required>
                                @error('prenom') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">Nom</label>
                            <div class="col-md-8">
                                <input type="text" name="nom" id="nom"
                                    class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom', Auth::user()->nom) }}" required>
                                @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-8">
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">Téléphone</label>
                            <div class="col-md-8">
                                <input type="text" name="telephone" id="telephone"
                                    class="form-control @error('telephone') is-invalid @enderror"
                                    value="{{ old('telephone', Auth::user()->telephone) }}" required>
                                @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row mb-3">
                            <label for="dateNaissance" class="col-md-4 col-form-label text-md-right">Date de Naissance</label>
                            <div class="col-md-8">
                                <input type="date" name="dateNaissance" id="dateNaissance"
                                    class="form-control @error('dateNaissance') is-invalid @enderror"
                                    value="{{ old('dateNaissance', Auth::user()->participant->dateNaissance) }}" required>
                                @error('dateNaissance') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="cni" class="col-md-4 col-form-label text-md-right">CNI</label>
                            <div class="col-md-8">
                                <input type="text" name="cni" id="cni"
                                    class="form-control @error('cni') is-invalid @enderror"
                                    value="{{ old('cni', Auth::user()->participant->cni) }}" required>
                                @error('cni') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="adresse" class="col-md-4 col-form-label text-md-right">Adresse</label>
                            <div class="col-md-8">
                                <input type="text" name="adresse" id="adresse"
                                    class="form-control @error('adresse') is-invalid @enderror"
                                    value="{{ old('adresse', Auth::user()->participant->adresse) }}" required>
                                @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <hr>

                        <h5 class="text-secondary mb-3"><i class="fas fa-lock mr-1"></i>Changer le mot de passe</h5>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nouveau mot de passe</label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirmer</label>
                            <div class="col-md-8">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save mr-1"></i>Mettre à jour
                                </button>
                                <a href="{{ route('profile') }}" class="btn btn-secondary ml-2">Annuler</a>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ml-2">
                                 <i class="fas fa-arrow-left me-1"></i>Retour
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
