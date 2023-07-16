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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title'); // Titre
            $table->text('target'); // liste des lecteurs autorisés : all, teacher, student,...
            $table->integer('author_id'); // id de l'auteur
            $table->string('slug'); // slug pour url
            $table->longText('content'); // contenu de l'article
            $table->text('keywords'); // mots-clés (séparés par des virgules)
            $table->string('associated_res'); // ressource associée à l'actualité (URL)
            $table->text('post_liked_users'); // liste des utilisateurs ayant liké l'actualité
            $table->string('state')->default('unpublished'); // 'published', 'draft', 'awaiting', 'unpublished'
            $table->boolean('pinned'); // mis en haut du listing ou pas (true ou false)
            $table->timestamps(); // Date de création, de modification de l'article
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
