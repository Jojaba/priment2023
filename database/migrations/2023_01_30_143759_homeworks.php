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
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre
            $table->string('slug'); // slug pour url
            $table->integer('author_id'); // id de l'auteur
            $table->string('classroom'); // Salle de classe
            $table->string('class'); // classe
            $table->date('date'); // pour le ...
            $table->time('time'); // ... à ...
            $table->text('content'); // contenu
            $table->string('associated_res'); // ressource associée à l'actualité (URL)
            $table->string('hw_liked_users'); // liste des utilisateurs ayant liké le devoir
            $table->string('state')->default('unpublished'); // 'published', 'draft', 'awaiting', 'unpublished'
            $table->timestamps(); // Date de création, de modification des devoirs
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeworks');
    }
};
