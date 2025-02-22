<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Exécute les migrations.
     */
    public function up(): void {
        // Table secretaire
        Schema::create('secretaire', function (Blueprint $table) {
            $table->id('id_secretaire');
            $table->string('nom_secretaire');
            $table->string('prenom_secretaire');
            $table->string('email_secretaire')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Table moniteur
        Schema::create('moniteur', function (Blueprint $table) {
            $table->id('id_moniteur');
            $table->string('nom_moniteur');
            $table->string('prenom_moniteur');
            $table->string('email_moniteur')->unique();
            $table->string('telephone_moniteur');
            $table->timestamps();
        });

        // Table cheval
        Schema::create('client', function (Blueprint $table) {
            $table->id('id_client');
            $table->string('nom_client');
            $table->string('email_client')->unique();
            $table->string('telephone_client');
            $table->timestamps();
        });

        // Table type_seance
        Schema::create('type_seance', function (Blueprint $table) {
            $table->id('id_type_seance');
            $table->string('nom_type_seance');
            $table->timestamps();
        });

        // Table cheval
        Schema::create('cheval', function (Blueprint $table) {
            $table->id('id_cheval');
            $table->string('nom_cheval');
            $table->date('naissance_cheval');
            $table->integer('heure_max_cheval');
            $table->timestamps();
        });

        // Table seance
        Schema::create('seance', function (Blueprint $table) {
            $table->id('id_seance');
            $table->integer('nb_chevaux');
            $table->dateTime('debut_seance');
            $table->dateTime('fin_seance');
            $table->unsignedBigInteger('id_secretaire');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_type_seance');
            $table->unsignedBigInteger('id_moniteur');
            $table->timestamps();

            $table->foreign('id_secretaire')->references('id_secretaire')->on('secretaire');
            $table->foreign('id_client')->references('id_client')->on('client');
            $table->foreign('id_type_seance')->references('id_type_seance')->on('type_seance');
            $table->foreign('id_moniteur')->references('id_moniteur')->on('moniteur');
        });

        // Table seance_cheval
        Schema::create('seance_cheval', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seance');
            $table->unsignedBigInteger('id_cheval')->nullable(); // Permettre les valeurs null;
            $table->timestamps();

            $table->foreign('id_seance')->references('id_seance')->on('seance')->onDelete('cascade');
            $table->foreign('id_cheval')->references('id_cheval')->on('cheval')->onDelete('cascade');
        });
    }

    /**
     * Annule les migrations.
     */
    public function down(): void {
        Schema::dropIfExists('seance_cheval');
        Schema::dropIfExists('seance');
        Schema::dropIfExists('type_seance');
        Schema::dropIfExists('client');
        Schema::dropIfExists('moniteur');
        Schema::dropIfExists('secretaire');
        Schema::dropIfExists('cheval');
    }
};
