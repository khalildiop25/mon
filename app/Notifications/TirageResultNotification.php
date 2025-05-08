<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Tontine;

class TirageResultNotification extends Notification
{
    use Queueable;

    protected $tontine;
    protected $gagnant;

    public function __construct(Tontine $tontine, $gagnant)
    {
        $this->tontine = $tontine;
        $this->gagnant = $gagnant;
    }

    public function via($notifiable)
    {
        return ['database'];  // Utilisation des notifications en base de données
    }

    public function toDatabase($notifiable)
{
    // Vérifie que les données sont bien présentes
    if (!$this->tontine || !$this->gagnant) {
        return [
            'message' => '⚠️ Erreur : données manquantes pour générer la notification du tirage.',
            'tontine_id' => null,
            'gagnant_id' => null,
        ];
    }

    return [
        'message' => "🎉 Félicitations ! Le tirage pour la tontine '{$this->tontine->libelle}' a été effectué. Le gagnant est {$this->gagnant->name}.",
        'tontine_id' => $this->tontine->id,
        'gagnant_id' => $this->gagnant->id,
    ];
}

}

