<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    protected $fillable = [
        'frequence',
        'libelle',
        'dateDebut',
        'dateFin',
        'description',
        'montant_total',
        'montant_de_base',
        'nbreParticipant',
    ];

    /**
     * Relation one-to-many avec le modèle Tirage.
     * Une tontine peut avoir plusieurs tirages.
     */
    public function tirages()
    {
        return $this->hasMany(Tirage::class, 'idTontine');
    }

    /**
     * Relation one-to-many avec le modèle Cotisation.
     * Une tontine peut avoir plusieurs cotisations.
     */
    public function cotisations()
    {
        return $this->hasMany(Cotisation::class, 'idTontine');
    }

    /**
     * Relation many-to-many avec le modèle Participant.
     * Une tontine peut avoir plusieurs participants et chaque participant peut participer à plusieurs tontines.
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'tontine_participant', 'tontine_id', 'participant_id');
    }
    public function images()
{
    return $this->hasMany(Image::class, 'idTontine');
}

}
