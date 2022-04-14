<?php

namespace App\Http\Controllers;

use Request;

use App\dao\ServiceVisiteur;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class VisiteurController extends Controller
{
    public function getLogin()
    {
        try {
            $erreur = "";
            return view('Vues.formLogin', compact('erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues.formLogin', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues.formLogin', compact('erreur'));
        }
    }

    public function signIn()
    {
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);
            if($connected){
                if (Session::get('type') === 'C') {
                    return view('home');
                }else{
                    Session::put('id')== "0";
                    $erreur = "vous n'avez pas les droits";
                    return view('Vues/formLogin', compact('connected','erreur'));
                }
            } else {
                $erreur = "Login ou mot de passe inconnu";
                return view('Vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/forLogin', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/forLogin', compact('erreur'));
        }
    }

    public function updatePassword($pwd)
    {
        $newpwd = Hash::make($pwd);
        try {
            $unLogin = new ServiceVisiteur();
            $unLogin->miseAjourMotPasse($newpwd);
            return view('home');
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Error', compact('erreur'));
        }
    }

    public function signOut()
    {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }
}
