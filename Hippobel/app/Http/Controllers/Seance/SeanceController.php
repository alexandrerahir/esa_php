<?php

// Namespace
namespace App\Http\Controllers\Seance;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Seance;
use App\Models\Client;
use App\Models\TypeSeance;
use App\Models\Moniteur;
use App\Models\SeanceCheval;
use App\Models\Cheval;
use Carbon\Carbon;

// Class SeanceController
class SeanceController extends Controller {

    /**
     * Afficher la liste des séances
     * 
     * @param Request $request
     */
    public function index(Request $request) {
        $date = $request->input('date', Carbon::today()->toDateString());

        $seances = Seance::with(['moniteur', 'client', 'secretaire'])
                            ->whereDate('debut_seance', $date)
                            ->orderBy('debut_seance', 'asc')
                            ->get();

        return view('seances.index', compact('seances', 'date'));
    }


    /*
     * Consulter une séance
     * 
     * @param int $id
     */
    public function consulter($id) {
        $seance = Seance::with(['client', 'moniteur', 'secretaire', 'typeSeance', 'chevaux'])->findOrFail($id);
        return view('seances.consulter', compact('seance'));
    }


    /**
     * Vue pour ajouter une séance
     */
    public function vueAjouter() {
        $clients = Client::orderBy('nom_client')->get();
        $moniteurs = Moniteur::orderBy('nom_moniteur')->get();
        $types = TypeSeance::orderBy('nom_type_seance')->get();
        return view('seances.ajouter', compact('clients', 'moniteurs', 'types'));
    }


    /**
     * Créer une séance
     * 
     * @param Request $request
     */
    public function ajouter(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'client' => 'required|exists:client,id_client',
            'type_seance' => 'required|exists:type_seance,id_type_seance',
            'nb_chevaux' => 'required|integer|min:1',
            'debut_seance' => 'required|date',
            'fin_seance' => 'required|date|after:debut_seance',
            'moniteur' => 'required|exists:moniteur,id_moniteur',
        ]);

        // Récupérer l'ID de la secrétaire connectée
        $id_secretaire = 1;

        // Création de la séance
        $seance = Seance::create([
            'id_client' => $validatedData['client'],
            'nb_chevaux' => $validatedData['nb_chevaux'],
            'debut_seance' => $validatedData['debut_seance'],
            'fin_seance' => $validatedData['fin_seance'],
            'id_moniteur' => $validatedData['moniteur'],
            'id_secretaire' => $id_secretaire,
            'id_type_seance' => $validatedData['type_seance'],
        ]);

        // Redirection après la création
        return redirect()->route('seances.index');
    }


    /**
     * Vue pour modifier une séance
     * 
     * @param int $id
     */
    public function vueModifier($id) {
        $seance = Seance::with(['client', 'moniteur', 'secretaire', 'typeSeance', 'chevaux'])->findOrFail($id);

        // Calculer la durée de la séance en heures
        $debutSeance = Carbon::parse($seance->debut_seance);
        $finSeance = Carbon::parse($seance->fin_seance);
        $dureeSeance = $debutSeance->diffInHours($finSeance);
    
        // Récupérer tous les chevaux
        $chevaux = Cheval::orderBy('nom_cheval')->get();
    
        // Filtrer les chevaux disponibles
        $chevauxDisponibles = $chevaux->filter(function ($cheval) use ($debutSeance, $dureeSeance) {
            // Calculer les heures déjà utilisées par le cheval pour la journée
            $heuresUtilisees = $cheval->seances()
                ->whereDate('debut_seance', $debutSeance->toDateString()) // Séances du même jour
                ->get()
                ->sum(function ($seance) {
                    return Carbon::parse($seance->debut_seance)->diffInHours(Carbon::parse($seance->fin_seance));
                });
    
            // Vérifier si le cheval a assez d'heures disponibles
            return ($cheval->heure_max_cheval - $heuresUtilisees) >= $dureeSeance;
        });
    
        $clients = Client::orderBy('nom_client')->get();
        $moniteurs = Moniteur::orderBy('nom_moniteur')->get();
        $types = TypeSeance::orderBy('nom_type_seance')->get();
    
        return view('seances.modifier', compact('seance', 'clients', 'moniteurs', 'types', 'chevauxDisponibles', 'dureeSeance'));
    }


    /**
     * Modifier une séance
     * 
     * @param Request $request
     * @param int $id
     */
    public function modifier(Request $request, $id) {
        // Validation des données
        $validatedData = $request->validate([
            'type_seance' => 'required|exists:type_seance,id_type_seance',
            'nb_chevaux' => 'required|integer|min:1',
            'debut_seance' => 'required|date',
            'fin_seance' => 'required|date|after:debut_seance',
            'moniteur' => 'required|exists:moniteur,id_moniteur',
            'chevaux' => 'required|array|min:1',
            'chevaux.*' => 'exists:cheval,id_cheval|distinct',
        ]);

        // Récupérer l'ID de la secrétaire connectée
        $id_secretaire = 1;

        // Récupérer la séance
        $seance = Seance::findOrFail($id);

        // Mettre à jour la séance
        $seance->update([
            'nb_chevaux' => $validatedData['nb_chevaux'],
            'debut_seance' => $validatedData['debut_seance'],
            'fin_seance' => $validatedData['fin_seance'],
            'id_moniteur' => $validatedData['moniteur'],
            'id_secretaire' => $id_secretaire,
            'id_type_seance' => $validatedData['type_seance'],
        ]);

        // Mettre à jour les chevaux associés à la séance
        $seance->chevaux()->sync($validatedData['chevaux']);

        // Redirection après la modification
        return redirect()->route('seances.consulter', $id);
    }


    /**
     * Supprimer une séance
     * 
     * @param int $id
     */
    public function supprimer($id) {
        // Récupérer la séance
        $seance = Seance::findOrFail($id);

        // Supprimer les enregistrements associés dans la table seance_cheval
        $seance->chevaux()->detach();

        // Supprimer la séance
        $seance->delete();

        // Redirection après la suppression
        return redirect()->to(url()->previous());
    }
} 
