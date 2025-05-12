<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sunu Kalpe</title>
<!--nouveau-->
{{--<link rel="stylesheet" href="{{ asset('css/footer.css') }}">--}}
<!-- Ou pour un favicon au format .png -->
<link rel="icon" type="image/jpg" href="{{ asset('favicon.jpg') }}">
<!--Tailwincss-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Bolt-->
    <link rel="stylesheet" href="{{ asset('css/bolt2.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--fin-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--fin-->
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!--TONTINE-->
        <!-- Custom styles for this template-->
    {{-- <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- pour alert -->
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>


<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Fin-->
    <!--a href="{{ route('tontines.index') }}" class="btn btn-primary">Voir la liste des tontines</a>-->
<style>
    .card-header{background-color: #c59d5f;}
.toggle-details {
    font-weight: bold; /* Rendre le texte plus foncé */
    color: #343a40; /* Couleur foncée pour le texte (tu peux ajuster à ton goût) */
    padding-right: 10px; /* Ajoute un peu d'espace entre le texte et l'icône*/
}
/*
.toggle-details i {
    margin-left: 5px; /* Ajoute un petit espacement entre l'icône et le texte *
    color: #343a40;
    font-size: 1.5em; /* Si tu veux que l'icône soit un peu plus grande, ajuste cette valeur *
}*/

    .bg-gold {
        background-color:  #1a365d !important;
    }
    /* Change la couleur du texte en doré */
    .navbar-gold a.nav-link,
    .navbar-gold .dropdown-item {
        color: #1a365d  !important;
    }

    /* Optionnel : Changer la couleur au survol */
    .navbar-gold a.nav-link:hover,
    .navbar-gold .dropdown-item:hover {
        color:  #E67E22 !important;
    }
    .admin {
    width: 50%;
    height: auto;
    border-radius: 100%;
    margin-right: 20px;
}

.bubble-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
    background: #f9f9f9; /* Couleur de fond */
}

.bubble-background::before,
.bubble-background::after {
    content: "";
    position: absolute;
    border-radius: 50%;
    opacity: 0.3;
    animation: floatBubbles 25s infinite ease-in-out;
}

.bubble-background::before {
    width: 60px;
    height: 60px;
    left: 20%;
    bottom: -100px;
    background: #ffc107;
}

.bubble-background::after {
    width: 80px;
    height: 80px;
    left: 70%;
    bottom: -150px;
    background: #ff9800;
}

@keyframes floatBubbles {
    0% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-300px) scale(1.2);
    }
    100% {
        transform: translateY(0) scale(1);
    }
}
</style>






</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body id="page-top" >


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar visible uniquement pour les utilisateurs ayant le rôle GERANT -->
        @if(Auth::check() && Auth::user()->profil == 'GERANT')
            @include('layouts.sidebar')  <!-- Inclut le sidebar uniquement pour les GERANT-->
        @endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid pb-24" >

                    <!-- Page Heading -->
                 @yield('content', view('welcome')) <!-- Affiche la vue 'home' par défaut si aucun contenu n'est spécifié -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            @include('layouts.footer')

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    @yield('scripts')


</body>

</html>
