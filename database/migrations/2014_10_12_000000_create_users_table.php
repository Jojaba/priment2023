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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom
            $table->string('forename'); // Prénom
            $table->string('identity')->default('élève'); // élève, enseignant, parent,...
            $table->integer('role')->default(0); // 0->visiteur, 5->contributeur, 10->rédacteur, 15->éditeur, 20->administrateur
            $table->date('birthdate')->nullable(); // Date de naissance
            $table->string('classroom'); // Salle de classe
            $table->string('class'); // classe
            $table->string('level'); // niveau (CP, CE1, CE2,...)
            $table->string('news_liked'); // actualités likées
            $table->string('hw_liked'); // devoirs likés
            $table->string('res_liked'); // ressources likées
            $table->string('email')->unique(); // Courriel
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); // Date de création (created_at), de modification (updated_at) de l'utilisateur
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
