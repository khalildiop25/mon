<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription - Tontine</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Additional custom styles-->
    <style>
        body {
            background: linear-gradient(90deg, #f5a623, #f39c12);
        }

        .register-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-return {
            background-color: #f39c12;
            color: white;
            padding: 8px 15px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-return:hover {
            background-color: #f5a623;
        }

        .form-control-user {
            height: 45px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #f39c12;
            border-color: #f39c12;
        }

        .btn-primary:hover {
            background-color: #f5a623;
            border-color: #f5a623;
        }

        .alert-danger {
            margin-bottom: 15px;
        }

        .text-center a {
            color: #f39c12;
        }

        .form-group small {
            color: red;
        }
    </style>

</head>

<body>

    <div class="container my-5">
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="register-container">
                    <!-- Retour Button -->
                    <a href="{{ url()->previous() }}" class="btn-return">
                        ← Retour
                    </a>

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Inscrivez-vous ici</h1>
                    </div>

                    <!-- Affichage du message d'erreur -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="user" action="{{route('incription.register')}}" method="post">
                        @csrf

                        <!-- Prénom et Nom -->
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" name="prenom" class="form-control form-control-user"
                                       placeholder="Votre prénom" value="{{ old('prenom') }}">
                                @error('prenom')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <input type="text" name="nom" class="form-control form-control-user"
                                       placeholder="Votre nom" value="{{ old('nom') }}">
                                @error('nom')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Email et Téléphone -->
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="email" name="email" class="form-control form-control-user"
                                       placeholder="Votre Email" value="{{ old('email') }}">
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <input type="text" name="telephone" class="form-control form-control-user"
                                       placeholder="Votre téléphone" value="{{ old('telephone') }}">
                                @error('telephone')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Date de Naissance et Adresse -->
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" name="dateNaissance" class="form-control form-control-user"
                                       value="{{ old('dateNaissance') }}">
                                @error('dateNaissance')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <input type="text" name="adresse" class="form-control form-control-user"
                                       placeholder="Votre adresse" value="{{ old('adresse') }}">
                                @error('adresse')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- CNI -->
                        <div class="form-group">
                            <input type="text" name="cni" class="form-control form-control-user"
                                   placeholder="Votre numéro national d'identification" value="{{ old('cni') }}">
                            @error('cni')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Mot de Passe -->
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-user"
                                       placeholder="Mot de passe" value="{{ old('password') }}">
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="password_confirmation" class="form-control form-control-user"
                                       placeholder="Confirmer le mot de passe" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            S'inscrire
                        </button>

                    </form>

                    <hr>

                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Mot de passe oublié ?</a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
