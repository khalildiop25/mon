<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateRetardeToCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotisations', function (Blueprint $table) {
            $table->date('date_retarde')->nullable();  // Ajouter le champ 'date_retarde' de type date
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotisations', function (Blueprint $table) {
            $table->dropColumn('date_retarde');  // Supprimer le champ 'date_retarde' si on annule la migration
        });
    }
}
