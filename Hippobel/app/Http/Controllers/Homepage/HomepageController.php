<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomepageController extends Controller {
    /**
     * Afficher la page d'accueil
     */
    public function index() {
        $aujourdhui = Carbon::today();
        $demain = Carbon::tomorrow();

        // Séances prévues aujourd'hui
        $nombreSeancesAujourdhui = Seance::whereDate('debut_seance', $aujourdhui)->count();

        // Séances prévues demain
        $nombreSeancesDemain = Seance::whereDate('debut_seance', $demain)->count();

        // Séances réalisées
        $nombreSeancesRealise = Seance::whereDate('fin_seance', '<', $aujourdhui)->count();

        return view('homepage', compact('nombreSeancesAujourdhui', 'nombreSeancesDemain', 'nombreSeancesRealise'));
    }
}
