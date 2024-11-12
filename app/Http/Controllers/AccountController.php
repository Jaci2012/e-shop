<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Client;
use App\Models\Vendeur;
use Illuminate\Http\Request;
use App\Models\User; // Assurez-vous d'importer le modèle User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Afficher la page de connexion
    public function login()
    {
        return view("account.login");
    }

    // Afficher la page d'inscription
    public function register()
    {
        $roles = Role::all();
        return view("account.register", compact("roles"));
    }

    // Gérer l'inscription
    public function storeRegister(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Validation pour role_id
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Création de l'utilisateur avec role_id
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hachage du mot de passe
            'role_id' => $request->role_id, // Assigner le rôle
        ]);

        // Ajout dans la table vendeurs ou clients en fonction du rôle
        if ($request->role_id == 1) { // Assurez-vous que 2 correspond au rôle 'Vendeur'
            Vendeur::create([
                'name' => $request->name,
                'email' => $request->email,
                'adresse' => $request->adresse ?? '', // Ajoutez d'autres champs si nécessaire
                'numero' => $request->numero ?? '',
                'roles_id' => $request->role_id,
            ]);
        } elseif ($request->role_id == 3) { // Assurez-vous que 3 correspond au rôle 'Clients'
            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'adresse' => $request->adresse ?? '', // Ajoutez d'autres champs si nécessaire
                'numero' => $request->numero ?? '',
                'roles_id' => $request->role_id,
            ]);
        }

        // Redirection après l'inscription
        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès ! Vous pouvez vous connecter.');
    }


    // Gérer la connexion
    public function storeLogin(Request $request)
    {
        // Validation des données de connexion
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            // Si la connexion réussit, redirection vers la page d'accueil
            return redirect()->intended('/dashboard')->with('success', 'Vous êtes connecté avec succès.');
        }

        // Si la connexion échoue, redirection vers la page de connexion avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }


}
