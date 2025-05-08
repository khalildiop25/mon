@extends('app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gold text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-user-circle mr-2"></i> Profil Utilisateur</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm">
                                 <i class="fas fa-arrow-left me-1"></i>Retour
                                </a>
                    <a href="{{ route('settings', auth()->user()->participant->id) }}" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-edit mr-1"></i>Modifier
                    </a>
                </div>

                <div class="card-body">
                    {{-- Informations personnelles --}}
                    <div class="row">
                        <div class="col-md-8">
                            @foreach ([
                                'Nom' => Auth::user()->nom,
                                'Prénom' => Auth::user()->prenom,
                                'Email' => Auth::user()->email,
                                'Téléphone' => Auth::user()->telephone,
                                'Date de Naissance' => Auth::user()->participant->dateNaissance,
                                'CNI' => Auth::user()->participant->cni,
                                'Adresse' => Auth::user()->participant->adresse,
                            ] as $label => $value)
                                <div class="form-group row mb-3">
                                    <label class="col-md-4 col-form-label text-md-right font-weight-bold">{{ $label }}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control-plaintext" value="{{ $value }}" readonly>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Photo de profil + upload --}}
                        <div class="col-md-4 text-center">
                            <label class="font-weight-bold d-block mb-2">Photo de Profil</label>
                            @if(Auth::user()->participant->imageCni)
                                <img src="{{ asset('storage/' . Auth::user()->participant->imageCni) }}"
                                     alt="Photo de profil" class="img-thumbnail mb-3" style="max-width: 150px;">
                            @else
                                <p class="text-muted">Pas de photo de profil.</p>
                            @endif

                            <form action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="photo" class="form-control-file" required>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">
                                        <i class="fas fa-upload mr-1"></i>Télécharger
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> {{-- fin .row --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom styles --}}
<style>
    .bg-gold {
        background-color: #DAA520;
    }
    .text-gold {
        color: #DAA520;
    }
</style>
@endsection
