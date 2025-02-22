<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Secretaire;
use App\Models\TypeSeance;
use App\Models\Cheval;
use App\Models\Moniteur;
use App\Models\Client;


class DatabaseSeeder extends Seeder {

    /**
     * Initialisation de la base de données
     */
    public function run(): void {
        // Création des secrétaires
        Secretaire::create([
            'nom_secretaire' => 'Rahir',
            'prenom_secretaire' => 'Alexandre',
            'email_secretaire' => 'alexandrerahir@hippobel.be',
            'password' => Hash::make('1234'),
        ]);

        Secretaire::create([
            'nom_secretaire' => 'Ernaelsten',
            'prenom_secretaire' => 'Gerard',
            'email_secretaire' => 'gerard@hippobel.be',
            'password' => Hash::make('1234'),
        ]);

        // Création des types de séances
        $typesSeance = [
            'Séance de rééducation',
            'Séance de relaxation',
            'Séance de développement moteur',
            'Séance éducative',
            'Séance de socialisation',
            'Séance de découverte',
            'Séance de préparation sportive'
        ];

        foreach ($typesSeance as $type) {
            TypeSeance::create(['nom_type_seance' => $type]);
        }

        // Création des chevaux
        $chevaux = [
            ['nom' => 'Tornado', 'naissance' => '2015-04-12', 'heure_max' => 6],
            ['nom' => 'Bella', 'naissance' => '2017-06-23', 'heure_max' => 5],
            ['nom' => 'Prince', 'naissance' => '2014-09-15', 'heure_max' => 7],
            ['nom' => 'Éclair', 'naissance' => '2016-03-30', 'heure_max' => 6],
            ['nom' => 'Duchesse', 'naissance' => '2018-11-10', 'heure_max' => 4],
            ['nom' => 'Spirit', 'naissance' => '2013-05-05', 'heure_max' => 7],
            ['nom' => 'Shadow', 'naissance' => '2019-02-19', 'heure_max' => 5],
        ];

        foreach ($chevaux as $cheval) {
            Cheval::create([
                'nom_cheval' => $cheval['nom'],
                'naissance_cheval' => $cheval['naissance'],
                'heure_max_cheval' => $cheval['heure_max'],
            ]);
        }

        // Création des moniteurs
        $moniteurs = [
            ['nom' => 'Dupont', 'prenom' => 'Luc', 'email' => 'luc.dupont@gmail.com', 'telephone' => '+32 472 12 34 56'],
            ['nom' => 'Van Damme', 'prenom' => 'Marie', 'email' => 'marie.vandamme@gmail.com', 'telephone' => '+32 473 65 43 21'],
            ['nom' => 'De Smet', 'prenom' => 'Thomas', 'email' => 'thomas.desmet@gmail.com', 'telephone' => '+32 476 78 90 12'],
            ['nom' => 'Janssens', 'prenom' => 'Elise', 'email' => 'elise.janssens@gmail.com', 'telephone' => '+32 471 34 12 78'],
            ['nom' => 'Peeters', 'prenom' => 'Hugo', 'email' => 'hugo.peeters@gmail.com', 'telephone' => '+32 474 56 78 90'],
            ['nom' => 'Vermeulen', 'prenom' => 'Sophie', 'email' => 'sophie.vermeulen@gmail.com', 'telephone' => '+32 475 67 89 01'],
            ['nom' => 'Claes', 'prenom' => 'Emma', 'email' => 'emma.claes@gmail.com', 'telephone' => '+32 472 89 01 23'],
        ];

        foreach ($moniteurs as $moniteur) {
            Moniteur::create([
                'nom_moniteur' => $moniteur['nom'],
                'prenom_moniteur' => $moniteur['prenom'],
                'email_moniteur' => $moniteur['email'],
                'telephone_moniteur' => $moniteur['telephone'],
            ]);
        }

        // Création des clients
        $clients = [
            ['nom' => 'École Primaire Saint-Michel', 'email' => 'saintmichel@ecoles.be', 'telephone' => '+32 71 23 45 89'],
            ['nom' => 'Centre d\'Aide Les Horizons', 'email' => 'contact@leshorizons.be', 'telephone' => '+32 65 45 23 89'],
            ['nom' => 'Institut Médico-Éducatif Soleil', 'email' => 'contact@ime-soleil.be', 'telephone' => '+32 81 76 54 32'],
            ['nom' => 'Foyer d\'Accueil Les Alouettes', 'email' => 'foyer@lesalouettes.be', 'telephone' => '+32 50 34 12 56'],
            ['nom' => 'Centre pour Enfants Autistes L\'Éveil', 'email' => 'info@leveil.be', 'telephone' => '+32 4 98 23 45 67'],
            ['nom' => 'Collège Sainte-Marie', 'email' => 'contact@sainte-marie.be', 'telephone' => '+32 2 345 67 89'],
            ['nom' => 'Maison de Repos Le Saule', 'email' => 'info@lesaule.be', 'telephone' => '+32 4 67 89 01 23'],
            ['nom' => 'Centre Thérapeutique Les Sources', 'email' => 'contact@lessources.be', 'telephone' => '+32 81 23 45 67'],
        ];

        foreach ($clients as $client) {
            Client::create([
                'nom_client' => $client['nom'],
                'email_client' => $client['email'],
                'telephone_client' => $client['telephone'],
            ]);
        }
    }
}
