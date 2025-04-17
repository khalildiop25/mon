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
   /**
     * Affiche la liste des tontines avec formulaire d'ajout d'image pour chacune.
     */
    public function create()
    {
        $tontines = Tontine::all(); // Récupérer toutes les tontines
        return view('images.create', compact('tontines'));
    }

    /**
     * Enregistre une nouvelle image pour une tontine spécifique
     */
   
public function store(Request $request, $idTontine)
{
    // Validation de l'image
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Vérifier si une image a été téléchargée
    if ($request->hasFile('image')) {
        $tontine = Tontine::findOrFail($idTontine);

        // 📦 Stocker l'image dans "public/images_tontines"
        $path = $request->file('image')->store('images_tontines', 'public');

        // 🗂 Enregistrer le chemin de l'image dans la base
        Image::create([
            'idTontine' => $tontine->id,
            'nomImage' => $path, // ici on stocke le chemin, pas juste le nom du fichier
        ]);

        return redirect()->back()->with('success', 'Image téléchargée avec succès.');
    }

    return redirect()->back()->with('error', 'Aucune image n\'a été téléchargée.');
}


    /**
     * Affiche les images d'une tontine
     */
    public function index($idTontine)
    {
        $tontine = Tontine::findOrFail($idTontine);
        $images = $tontine->images;

        return view('images.index', compact('images', 'tontine'));
    }

    /**
     * Supprime une image
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $imagePath = public_path('images/tontines/' . $image->nomImage);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }

    ////image tontine
    
}