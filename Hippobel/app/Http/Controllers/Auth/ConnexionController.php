<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller {
    public function vueConnexion() {
        return view('auth.connexion');
    }

    public function connexion(Request $request) {
        $request->validate([
            'email_secretaire' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email_secretaire' => $request->email_secretaire, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return to_route('auth.connexion')->withErrors(
            ['email' => 'Oups ! Ces informations ne correspondent à aucun compte.']
        );

    }

    public function deconnexion(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('auth.connexion');
    }
}
