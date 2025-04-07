<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotisations', function (Blueprint $table) {
            
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idTontine');
            $table->integer('montant');
            $table->enum('moyen_paiement', ['ESPECES', 'WAVE', 'OM']); // Moyen de paiement
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idTontine')->references('id')->on('tontines');

            $table->unique(['idUser', 'idTontine', 'created_at']);
            
            // Ajoute une contrainte UNIQUE si nécessaire pour éviter les doublons
            // (par exemple, un participant ne doit pas cotiser plusieurs fois le même jour pour une même tontine)
            //c$table->unique(['idUser', 'idTontine', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};

