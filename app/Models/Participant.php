<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'idUser',
        'dateNaissance',
        'cni',
        'adresse',
        'imageCni',
    ];

    /**
     * Relation avec le modèle User.
     * Un participant appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    /**
     * Relation avec le modèle Tontine.
     * Un participant peut être associé à plusieurs tontines.
     * Cette relation est une relation "many-to-many" à travers une table pivot.
     */
    public function tontines()
    {
        return $this->belongsToMany(Tontine::class, 'tontine_participant', 'participant_id', 'tontine_id');
    }
    public function cotisations()
{
    return $this->hasMany(Cotisation::class, 'idUser'); // On suppose que idUser dans la table cotisations fait référence à l'utilisateur
}
    
}
