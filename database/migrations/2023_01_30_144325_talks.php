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
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->string('subject'); // Objet du message
            $table->text('content'); // Objet du message
            $table->integer('author_id'); // id de l'auteur
            $table->text('recipients_id'); // id des destinataires
            $table->timestamps(); // Date de création, de modification de la discussion
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talks');
    }
};
