<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous Contacter - Sunu-Kalpe</title>


       {{-- <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/all.min.css') }}">--}}


    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Effet de points */
        .dotted-bg::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 180px; /* Largeur des points */
            height: 100%; /* Prend toute la hauteur */
            background-image: radial-gradient(rgb(200, 200, 200) 1px, transparent 1px);
            background-size: 10px 10px; /* Taille des points */
            opacity: 0.5;

        }
    </style>
</head>
<body class="bg-gray-100  "  >

    <!-- Section d'introduction avec effet de points -->
    <div class="relative bg-gray-50 py-24 px-6 text-center dotted-bg">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Contactez l'équipe Sunu Kalpe</h1>
            <p class="mt-4 text-gray-600 text-lg">Vous souhaitez obtenir plus d’informations sur nos produits et services ?<br>
            Notre service client se tient à votre écoute.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12  ">
        <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row ">

            <!-- Section Infos -->
            <div class="bg-green-500 text-white p-8 w-full md:w-1/3">
                <h2 class="text-2xl font-bold">Informations de contact</h2>
                <p class="mt-4">Pour tous vos besoins d'informations, contactez-nous ou suivez-nous sur nos réseaux sociaux.</p>

                <div class="mt-6 space-y-4">
                    <p><i class="fa fa-phone-alt"></i> +221 33 419 21 21 / 78 303 24 82</p>
                    <p><i class="fa fa-envelope"></i> service.client@sunu-kalpe.com</p>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="#" class="text-white text-2xl"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-white text-2xl"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white text-2xl"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="p-8 w-full md:w-2/3">
                <h2 class="text-2xl font-bold text-gray-800">Envoyez-nous un message</h2>

                <form action="{{ route('contact') }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Nom <span style="color:red;">*</span></</label>
                            <input type="text" name="nom" class="w-full p-2 border rounded" required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Prénom <span style="color:red;">*</span></label>
                            <input type="text" name="prenom" class="w-full p-2 border rounded" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Email <span style="color:red;">*</span></label>
                            <input type="email" name="email" class="w-full p-2 border rounded" required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Téléphone <span style="color:red;">*</span></label>
                            <input type="text" name="telephone" class="w-full p-2 border rounded" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700">Objet <span style="color:red;">*</span></label>
                        <input type="text" name="objet" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="block text-gray-700">Message <span style="color:red;">*</span></label>
                        <textarea name="message" rows="4" class="w-full p-2 border rounded" required></textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="newsletter" class="mr-2">
                        <label class="text-gray-700">Je m'inscris à la newsletter</label>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
