<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Définir les commandes artisan disponibles pour l'application.
     *
     * @var array
     */
    protected $commands = [
        // Enregistre les commandes artisan personnalisées ici
        \App\Console\Commands\TirageAutomatique::class,
    ];

    /**
     * Définir la planification des tâches pour l'application.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Exemple de planification de commande à 15h chaque jour
        $schedule->command('tirage:execute')->dailyAt('15:00');
    }

    /**
     * Enregistrer les commandes artisan.
     *
     * @return void
     */
    protected function commands()
    {
        // Enregistrer toutes les commandes Artisan
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
