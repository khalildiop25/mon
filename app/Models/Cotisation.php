<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    // Laravel gère l'auto-incrémentation de la colonne 'id' par défaut
    protected $fillable = [
        'idUser',
        'idTontine',
        'montant',
        'moyen_paiement',
        'etat_paiement',
    ];

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // Définir la relation avec le modèle Tontine
    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idTontine');
    }
}
