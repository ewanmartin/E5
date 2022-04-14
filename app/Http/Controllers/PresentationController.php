<?php

namespace App\Http\Controllers;

use App\dao\ServicePresentation;

class PresentationController
{
    public function getPresentation()
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePresentation= new ServicePresentation();
                $mesPresentation = $unServicePresentation->getLesPresentation();
                return view('Vues.listeMedicament', compact('mesPresentation', 'erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('Vues.pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('Vues.pageErreur', compact('erreur'));
            }
        } else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('Vues.formLogin', compact('erreur'));
        }
    }
}
