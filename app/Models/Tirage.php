<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tirage extends Model
{
    // Désactive l'auto-incrémentation
    public $incrementing = false;

    // Clé primaire non standard (pas "id")
    protected $primaryKey = ['idUser', 'idTontine'];

    protected $fillable = [
        'idUser',   // ID de l'utilisateur lié au tirage
        'idTontine' // ID de la tontine associée
    ];

    // Indique que la clé primaire n'est pas une chaîne UUID
    protected $keyType = 'int';

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idTontine');
    }
}
