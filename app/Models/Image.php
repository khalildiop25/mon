<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'idTontine', // La clé étrangère vers la table des tontines
        'nomImage'   // Le nom du fichier image ou son chemin
    ];

    /**
     * Relation avec la tontine
     */
    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idTontine');
    }
}
