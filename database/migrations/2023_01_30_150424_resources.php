<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre
            $table->string('keywords'); // mots-clés
            $table->string('url'); // lien vers la ressource
            $table->string('location'); // disponible sur primENT (local) ou sur le Web (web)
            $table->string('type'); // doc, pdf, video, exercice en ligne,...
            $table->integer('author_id'); // id de l'auteur
            $table->string('res_liked_users'); // liste des utilisateurs ayant liké la ressource
            $table->string('state')->default('unpublished'); // 'published', 'draft', 'awaiting', 'unpublished'
            $table->timestamps(); // Date de création, de modification de la ressource
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
};
