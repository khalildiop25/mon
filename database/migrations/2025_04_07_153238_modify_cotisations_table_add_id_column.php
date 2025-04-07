<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cotisations', function (Blueprint $table) {
            // Supprimer la clé primaire existante si elle existe
            $table->dropPrimary(); // Supprimer la clé primaire actuelle

            // Ajouter la colonne 'id' comme clé primaire auto-incrémentée
            $table->id()->first(); // Créer une colonne id auto-incrémentée et la mettre en première position
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotisations', function (Blueprint $table) {
            // Supprimer la colonne 'id'
            $table->dropColumn('id');

            // Réajouter la clé primaire composée (idUser, idTontine)
            $table->primary(['idUser', 'idTontine']); // Recréer la clé primaire composée
        });
    }
};
