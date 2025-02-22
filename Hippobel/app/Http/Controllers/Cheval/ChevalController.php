<?php

namespace App\Http\Controllers\Cheval;

use App\Http\Controllers\Controller;
use App\Models\Cheval;
use Illuminate\Http\Request;

class ChevalController extends Controller {

    /**
     * Afficher la liste des chevaux
     */
    public function index() {
        $chevaux = Cheval::all();
        return view('cheval.index', compact('chevaux'));
    }

    /**
     * Vue pour ajouter un cheval
     */
    public function vueAjouter() {
        return view('cheval.ajouter');
    }

    /**
     * Ajouter un cheval
     * 
     * @param Request $request
     */
    public function ajouter(Request $request) {
        $request->validate([
            'nom_cheval' => 'required|string|max:255',
            'naissance_cheval' => 'required|date',
            'heure_max_cheval' => 'required|integer|min:1',
        ]);

        Cheval::create($request->all());
        return redirect()->route('chevaux.index');
    }

    /**
     * Vue pour modifier un cheval
     * 
     * @param int $id
     */
    public function vueModifier($id) {
        $cheval = Cheval::find($id);
        return view('cheval.modifier', compact('cheval'));
    }

    /**
     * Modifier un cheval
     * 
     * @param Request $request
     * @param int $id
     */
    public function modifier(Request $request, $id) {
        $request->validate([
            'nom_cheval' => 'required|string|max:255',
            'naissance_cheval' => 'required|date',
            'heure_max_cheval' => 'required|integer|min:1',
        ]);

        $cheval = Cheval::find($id);
        $cheval->update($request->all());
        return redirect()->route('chevaux.index');
    }

    /**
     * Supprimer un cheval
     * 
     * @param int $id
     */
    public function supprimer($id) {
        Cheval::destroy($id);
        return redirect()->route('chevaux.index');
    }
}
