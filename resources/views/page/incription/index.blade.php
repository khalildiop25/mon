<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Inscrivez-vous ici!!!</h1>
                            </div>
                            <form class="user" action="{{route('incription.register')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    {{-- champs prénom --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="prenom" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Votre prénom">
                                            @error('prenom')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="nom" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Votre nom" value="{{old('nom')}}">
                                            @error('nom')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- champs prénom --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Votre Email" value="{{ old('email') }}">
                                            @error('email')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="telephone" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Votre téléphone" value="{{old('telephone')}}">
                                            @error('telephone')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                            
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- champs prénom --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" name="dateNaissance" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Votre date de naissance" value="{{old('dateNaissance')}}">
                                            @error('dateNaissance')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="adresse" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Votre adresse" value="{{old('adresse')}}">
                                            @error('adresse')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{-- champs prénom --}}
                                        <input type="text" name="cni" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Votre numéro national d'indentification" value="{{old('cni')}}">
                                            @error('cni')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
    <input type="password" name="password" class="form-control form-control-user"
        id="exampleInputPassword" placeholder="Password" value="{{ old('password') }}">
    @error('password')
        <small style="color: red">{{$message}}</small>
    @enderror
</div>
<div class="col-sm-6">
    <input type="password" name="password_confirmation" class="form-control form-control-user"
        id="exampleRepeatPassword" placeholder="Repeat Password" value="{{ old('password_confirmation') }}">
    @error('password_confirmation')
        <small style="color: red">{{$message}}</small>
    @enderror 
</div>

                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    S'inscrire
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                        </div>
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
