<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tirage extends Model
{
    protected $fillable = [
        'idUser',   // ID de l'utilisateur lié au tirage
        'idTontine', // ID de la tontine associée
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