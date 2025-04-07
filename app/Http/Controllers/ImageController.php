<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tontine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Méthode pour l'upload de la photo
    public function uploadPhoto(Request $request)
    {
        // Validation de l'image
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de la photo
        ]);

        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur a un profil de participant
        $participant = $user->participant;

        // Si un fichier est téléchargé, on le stocke
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo, si elle existe
            if ($participant->imageCni) {
                Storage::delete('public/' . $participant->imageCni);
            }

            // Stocker la nouvelle photo et obtenir son chemin
            $path = $request->file('photo')->store('photos', 'public');

            // Mettre à jour le chemin de la photo dans la table participants
            $participant->imageCni = $path;
            $participant->save(); // Sauvegarder le modèle participant

            return back()->with('success', 'Photo de profil mise à jour avec succès!');
        }

        return back()->with('error', 'Erreur lors de l\'upload de la photo.');
    }



    /**
     * Affiche le formulaire pour télécharger une image pour une tontine spécifique
     */
    public function create($idTontine)
    {
        $tontine = Tontine::findOrFail($idTontine); // Récupère la tontine
        return view('images.create', compact('tontine'));
    }

    /**
     * Enregistre une nouvelle image pour une tontine spécifique
     */
    public function store(Request $request, $idTontine)
    {
        // Validation de l'image téléchargée
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            // Générer un nom unique pour l'image
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/tontines'), $imageName); // Déplacer l'image dans le dossier

            // Enregistrement de l'image dans la base de données
            $image = new Image();
            $image->idTontine = $idTontine;  // Lier l'image à la tontine
            $image->nomImage = $imageName;   // Enregistrer le nom de l'image
            $image->save();

            // Retourner une réponse ou rediriger
            return redirect()->route('tontines.show', $idTontine)->with('success', 'Image téléchargée avec succès.');
        }

        // Si aucune image n'est téléchargée
        return back()->with('error', 'Aucune image n\'a été téléchargée.');
    }

    /**
     * Affiche toutes les images associées à une tontine spécifique
     */
    public function index($idTontine)
    {
        $tontine = Tontine::findOrFail($idTontine);  // Récupérer la tontine
        $images = $tontine->images;  // Récupérer les images associées à la tontine

        return view('images.index', compact('images', 'tontine'));  // Passer les données à la vue
    }

    /**
     * Supprime une image spécifique
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);  // Récupérer l'image
        $imagePath = public_path('images/tontines/'.$image->nomImage);  // Chemin complet du fichier

        // Vérifier si le fichier existe avant de le supprimer
        if (File::exists($imagePath)) {
            File::delete($imagePath);  // Supprimer le fichier
        }

        // Supprimer l'enregistrement dans la base de données
        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }
}