@extends('app')  <!-- Utiliser la mise en page générale de l'application -->

@section('content')
    <div class="container mt-5">
        <!-- Message de succès s'il y en a -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card pour modifier les informations du profil -->
                <div class="card">
                    <div class="card-header">{{ __('Modifier le Profil') }}</div>

                    <div class="card-body">
                        <!-- Formulaire pour modifier les informations de l'utilisateur -->
                        <form method="POST" action="{{ route('set') }}">
                            @csrf
                            @method('PUT') <!-- Utilisation de la méthode PUT pour la mise à jour -->

                            <div class="row mb-3">
                                <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prénom') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', Auth::user()->prenom) }}" required>
                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="nom" value="{{ old('nom', Auth::user()->nom) }}" required>
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Téléphone') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', Auth::user()->telephone) }}" required>
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="dateNaissance" class="col-md-4 col-form-label text-md-end">{{ __('Date de Naissance') }}</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('dateNaissance') is-invalid @enderror" id="dateNaissance" name="dateNaissance" value="{{ old('dateNaissance', Auth::user()->participant->dateNaissance) }}" required>
                                    @error('dateNaissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cni" class="col-md-4 col-form-label text-md-end">{{ __('CNI') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('cni') is-invalid @enderror" id="cni" name="cni" value="{{ old('cni', Auth::user()->participant->cni) }}" required>
                                    @error('cni')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="adresse" class="col-md-4 col-form-label text-md-end">{{ __('Adresse') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse', Auth::user()->participant->adresse) }}" required>
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Formulaire pour modifier le mot de passe -->
                            <hr>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Nouveau Mot de Passe') }}</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer le Mot de Passe') }}</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Mettre à jour le profil') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
