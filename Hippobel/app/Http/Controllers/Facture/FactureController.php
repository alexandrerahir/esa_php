<?php

namespace App\Http\Controllers\Facture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Seance;
use Carbon\Carbon;


class FactureController extends Controller {
    
    /**
     * Afficher la liste des factures
     * 
     * @param Request $request
     */
    public function index(Request $request) {
        // Récupérer le mois et l'année sélectionnés ou utiliser le mois précédent par défaut
        $monthYear = $request->input('monthYear', Carbon::now()->subMonth()->format('Y-m'));
        $date = Carbon::createFromFormat('Y-m', $monthYear);

        // Récupérer les clients qui ont réalisé des séances dans le mois et l'année sélectionnés
        $clients = Client::whereHas('seances', function ($query) use ($date) {
            $query->whereMonth('debut_seance', $date->month)
                    ->whereYear('debut_seance', $date->year);
        })->get();

        // Calculer les valeurs pour chaque client
        $clientsData = $clients->map(function ($client) use ($date) {
            $seances = $client->seances()->whereMonth('debut_seance', $date->month)
                                            ->whereYear('debut_seance', $date->year)
                                            ->get();

            $totalHours = $seances->sum(function ($seance) {
                return Carbon::parse($seance->debut_seance)->diffInHours(Carbon::parse($seance->fin_seance));
            });

            $totalChevaux = $seances->sum('nb_chevaux');
            $totalAmount = $totalHours * $totalChevaux * 25;

            return [
                'client' => $client,
                'totalHours' => $totalHours,
                'totalChevaux' => $totalChevaux,
                'totalAmount' => $totalAmount,
            ];
        });

        // Calculer les totaux pour le mois
        $totalMonthHours = $clientsData->sum('totalHours');
        $totalMonthChevaux = $clientsData->sum('totalChevaux');
        $totalMonthAmount = $clientsData->sum('totalAmount');

        return view('factures.index', compact('clientsData', 'monthYear', 'totalMonthHours', 'totalMonthChevaux', 'totalMonthAmount'));
    }
}
