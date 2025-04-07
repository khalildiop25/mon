<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTontineParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tontine_participant', function (Blueprint $table) {
            $table->id();
            
            // Modifier la clé étrangère pour référencer la colonne idUser de participants
            $table->unsignedBigInteger('participant_id'); // La colonne fait référence à idUser de participants
            $table->unsignedBigInteger('tontine_id');
            
            // Définir les clés étrangères manuellement
            $table->foreign('participant_id')
                  ->references('idUser') // Faire référence à la colonne idUser dans participants
                  ->on('participants')
                  ->onDelete('cascade'); // Si un participant est supprimé, supprimer l'entrée correspondante dans la table pivot

            $table->foreign('tontine_id')
                  ->references('id') // Référence à la colonne id dans tontines
                  ->on('tontines')
                  ->onDelete('cascade'); // Si une tontine est supprimée, supprimer l'entrée correspondante dans la table pivot

            $table->timestamps();

            // Ajouter une contrainte unique pour éviter les doublons entre participant_id et tontine_id
            $table->unique(['participant_id', 'tontine_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tontine_participant');
    }
}
