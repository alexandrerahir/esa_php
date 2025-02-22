<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {
    /*
     * Afficher la liste des clients
     */
    public function index() {
        $clients = Client::all();
        return view('client.index', compact('clients'));
    }

    /*
     * Vue pour ajouter un client
     */
    public function vueAjouter() {
        return view('client.ajouter');
    }

    /*
     * Ajouter un client
     * 
     * @param Request $request
     */
    public function ajouter(Request $request) {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|email',
            'telephone_client' => 'required|string|max:10',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index');
    }

    /*
    * Vue pour modifier un client
    *
    * @param int $id
    */ 
    public function vueModifier($id) {
        $client = Client::find($id);
        return view('client.modifier', compact('client'));
    }

    /*
    * Modifier un client
    *
    * @param Request $request
    * @param int $id
    */
    public function modifier(Request $request, $id) {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|email',
            'telephone_client' => 'required|string',
        ]);

        $client = Client::find($id);
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    /*
    * Supprimer un client
    *
    * @param int $id
    */
    public function supprimer($id) {
        Client::destroy($id);
        return redirect()->route('clients.index');
    }

}
