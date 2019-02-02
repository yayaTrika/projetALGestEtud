<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idEtudiant')->unsigned()->index();
            $table->foreign('idEtudiant')->references('id')->on('etudiants')->onDelete('cascade');

            $table->integer('idNiveux')->unsigned()->index();
            $table->foreign('idNiveux')->references('id')->on('niveaux')->onDelete('cascade');
            $table->string('annee');           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }
}
