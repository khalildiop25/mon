<?php

// Déclare l’espace de noms du fichier
namespace App\Console\Commands;

// Importe les classes nécessaires
use Illuminate\Console\Command;
use App\Models\Tontine;
use App\Models\Tirage;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\TirageResultNotification;


// Classe de commande artisan personnalisée
class TirageAutomatique extends Command
{
    // Signature pour exécuter cette commande via le terminal : php artisan tirage:execute
    protected $signature = 'tirage:execute';

    // Description de la commande (affichée avec `php artisan list`)
    protected $description = 'Effectue le tirage à 15h selon la fréquence des tontines';

    // Méthode principale qui est appelée lorsqu’on exécute la commande
    public function handle()
    {
        // On récupère la date et l’heure actuelle
        $now = Carbon::now();

        // On récupère toutes les tontines existantes
        $tontines = Tontine::all();

        // On parcourt chaque tontine pour voir si elle doit faire un tirage
        foreach ($tontines as $tontine) {
            $doTirage = false; // Flag pour savoir si on doit faire le tirage

            // On vérifie la fréquence de la tontine pour décider si c’est le moment de tirer
            switch (strtoupper($tontine->frequence)) {
                case 'JOURNALIERE':
                    $doTirage = true; // Chaque jour
                    break;
                case 'HEBDOMADAIRE':
                    $doTirage = $now->isMonday(); // Chaque lundi
                    break;
                case 'MENSUEL':
                    $doTirage = $now->day === 1; // Le 1er de chaque mois
                    break;
            }

            // Si c’est bien le bon jour pour tirer
            if ($doTirage) {
                // On vérifie si un tirage a déjà été fait aujourd’hui pour cette tontine
                $alreadyTire = Tirage::where('idTontine', $tontine->id)
                    ->whereDate('created_at', today())
                    ->count() > 0;

                // Si aucun tirage n’a encore été enregistré aujourd’hui
                if (!$alreadyTire) {
                    // On récupère les participants de la tontine
                    $participants = $tontine->participants;

                    // S’il y a bien des participants
                    if ($participants->isNotEmpty()) {
                        // On sélectionne un participant au hasard
                        $gagnant = $participants->random();

                        // On crée une ligne dans la table `tirages` pour enregistrer le gagnant
                        Tirage::create([
                            'idUser' => $gagnant->idUser,
                            'idTontine' => $tontine->id,
                        ]);

                        // ✅ Notification envoyée ici
                        $gagnant->user->notify(new TirageResultNotification($tontine, $gagnant->user));

                        // Message affiché dans la console pour suivi
                        $this->info("Tirage effectué pour la tontine '{$tontine->libelle}' : gagnant - " . $gagnant->user->nom);
                    }
                }
            }
        }

        // On retourne un succès à la fin de la commande
        return Command::SUCCESS;
    }
}

