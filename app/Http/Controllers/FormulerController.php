<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormuler;
use App\dao\ServiceLeMedicament;
use Illuminate\Database\QueryException;
use App\dao\ServicePresentation;
use Illuminate\Support\Facades\DB;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Exceptions\MonException;

class FormulerController
{

    public function listerFormule($id_medicament)
    {
        try {
            $erreur = Session::get('erreur');
            $unServiceFormulation = new ServiceFormuler();
            $unServiceMedicament = new ServiceLeMedicament();
            $mesFormulations = $unServiceFormulation->getlisteFormule($id_medicament);
            $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
            return view('Vues.formFormule', compact('mesFormulations','leMedicament' ));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues.pageErreur', compact('erreur'));
        } catch
        (\Exception $ex) {
            $erreur = $ex->getMessage();
            return view('Vues.pageErreur', compact('erreur'));
        }
    }

    public function surpprimerFormule($id_medicament, $id_presentation)
    {
        $unServiceFormulation = new ServiceFormuler();
        $unServiceMedicament = new ServiceLeMedicament();
        try {
            $unServiceFormulation->deleteFormule($id_medicament, $id_presentation);
            $leMedicament = $unServiceMedicament->getLeMedoc($id_medicament);
            $mesFormulations = $unServiceFormulation->getlisteFormule($id_medicament);
            return view('Vues.formFormule', compact('leMedicament','mesFormulations'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            Session::put('erreur', 'impossible de suprimer ');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            Session::put('erreur', 'impossible de suprimer ');
        }
    }

    public function affichageAjoutFormulation($id_medicament)
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormuler();
                $unServicePresentation = new ServicePresentation();
                $unServiceMedicament = new ServiceLeMedicament();
                $mesFormulations = $unServiceFormulation->getlisteFormule($id_medicament);
                $mesPresentation = $unServicePresentation->getLesPresentation();
                $leMedicament = $unServiceMedicament->getLeMedoc($id_medicament);
                return view('Vues.formFormulation', compact('leMedicament','mesPresentation','mesFormulations','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('Vues.pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('Vues.pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('Vues.formLogin', compact('erreur'));
        }
    }

    public function ajouterLaFormulation()
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_presentation = Request::input('id_presentation');
                $qte_formuler = Request::input('qte_formuler');
                $unServiceFormulation = new ServiceFormuler();
                $unServiceMedicament = new ServiceLeMedicament();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $ajoutFormulation = $unServiceFormulation->ajouterLaFormulation($id_medicament, $id_presentation, $qte_formuler);
                $mesFormulations = $unServiceFormulation->getlisteFormule($id_medicament);
                return view('Vues.formFormule', compact('leMedicament','mesFormulations', 'erreur'));
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

    public function updateFormulation($id_medicament, $id_presentation)
    {
        try {
            $erreur = "";
            $unServicePresentation = new ServicePresentation();
            $unServiceFormuler = new ServiceFormuler();
            $unServiceMedicament = new ServiceLeMedicament();
            $uneFormulation = $unServiceFormuler->getByHorsId($id_medicament, $id_presentation);
            $mesPresentation = $unServicePresentation->getLesPresentation();
            $mesFormulations = $unServiceFormuler->getlisteFormule($id_medicament);
            $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
            $laPresentation = $unServicePresentation->getLaPresentation($id_presentation);
            return view('Vues.formFormulation', compact('uneFormulation','mesFormulations','leMedicament','laPresentation', 'mesPresentation', 'erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues.PageErreur', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues.PageErreur', compact('erreur'));
        }
    }

    public function updateLaformulation()
    {
        try {
            $erreur = "";
            $id_medicament = Request::input('id_medicament');
            $id_presentation = Request::input('id_presentation');
            $oldprensetation = Request::input('oldprensetation');
            if ($id_presentation == "") {
                $id_presentation = $oldprensetation;
            }
            $qte_formuler = Request::input('qte_formuler');
            $unServiceFormuler = new ServiceFormuler();
            $unServicePresentation = new ServicePresentation();
            $unServiceMedicament = new ServiceLeMedicament();
            $mesPresentation = $unServicePresentation->getLesPresentation();
            $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
            $LaFormulations = $unServiceFormuler->updateFormulation($id_medicament, $oldprensetation, $id_presentation, $qte_formuler);
            $mesFormulations = $unServiceFormuler->getlisteFormule($id_medicament);
            return view('Vues.formFormule', compact('mesFormulations','leMedicament','mesPresentation', 'erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues.PageErreur', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues.PageErreur', compact('erreur'));
        }
    }
}
