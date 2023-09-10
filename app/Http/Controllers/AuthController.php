<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        $tokenUser = Auth::attempt($credentials);

        if($tokenUser) {

            $admin = Auth::user()->role == 'admin';

            if($admin) {
                Alert::toast('Vous êtes bien connecté(e)s', 'success')->position('top');
                return redirect()->route('admin.dashboard');
            } else {
                
                Alert::toast('Vous êtes bien connecté(e)s', 'success')->position('top');
                return redirect()->back();
            }

        } else {
            Alert::toast('Veuillez correctement les champs ', 'error')->position('top');
            return redirect()->back();
        }

    }

    public function loginInModal(Request $request) {

        $credentials = $request->only('email', 'password');

        $tokenUser = Auth::attempt($credentials);

        if($tokenUser) {

            alert()->success("Connexion réussie", "Bienvenue sur le site")->autoClose(3000);
            return redirect()->back();

        } else {
            alert()->success("Connexion échouée", "Veuillez renseigner correctement les champs");
            return back();
        }

    }

    public function registerView() {
        return view('auth.register');
    }

    public function register(Request $request) {

        $request->validate([
            'username' => 'required|min:5',
            'email' => 'required|email|string|unique:users',
            'date_naissance' => 'required',
            'password' => 'required|min:5'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->date_naissance = $request->date_naissance;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        if($user) {

            Auth::login($user);

            Alert::toast('Inscription effectuée avec succès', 'success')->position('top');

            return redirect()->route('acceuil')->with('success', 'Inscription effectuée avec succès');

        } else {

            Alert::toast('Une erreur s\'est produite', 'error')->position('top');

            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }

    }

    public function logout(){

        Auth::logout();
        Alert::toast('Vous êtes déconnecté(e)s', 'success')->position('top');
        return redirect()->route('acceuil')->with('success', 'Compte déconnecté');

    }
}
