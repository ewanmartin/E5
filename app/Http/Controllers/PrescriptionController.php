<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormuler;
use App\dao\ServiceLeMedicament;
use App\dao\ServicePrescription;
use App\dao\ServiceDosage;
Use App\dao\ServiceTypeIndividus;
use App\dao\ServicePresentation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Request;

class PrescriptionController
{
    public function listerPreciption($id_medicament)
    {

        try {
            $erreur = Session::get('erreur');
            $unPrecipstion = new ServicePrescription();
            $unMedicament = new ServiceLeMedicament();
            $leMedicament = $unMedicament->getLeMedoc($id_medicament);
            $mesPrescription = $unPrecipstion->getlistePrescription($id_medicament);
            return view('Vues.formPresciption', compact('leMedicament', 'mesPrescription',));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues.pageErreur', compact('erreur'));
        } catch (\Exception $ex) {
            $erreur = $ex->getMessage();
            return view('Vues.pageErreur', compact('erreur'));
        }
    }

    public function ajouterLaPrescription()
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_dosage = Request::input('id_dosage');
                $id_type_individu = Request::input('id_type_individu');
                $posologie = Request::input('posologie');
                $unPrecipstion = new ServicePrescription();
                $unMedicament = new ServiceLeMedicament();
                $ajoutPrescription = $unPrecipstion->ajouterlaprescription($id_dosage, $id_medicament, $id_type_individu, $posologie);
                $mesPrescription = $unPrecipstion->getlistePrescription($id_medicament);
                $leMedicament = $unMedicament->getleMedoc($id_medicament);
                return view('Vues.formPresciption', compact('leMedicament', 'mesPrescription', 'erreur'));
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

    public function supprimerPrescription($id_medicament, $id_dosage, $id_type_individu)
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePrescription = new ServicePrescription();
                $unServiceMedicament = new ServiceLeMedicament();
                $suppPrescription = $unServicePrescription->deletePresciption($id_dosage, $id_medicament, $id_type_individu);
                $mesPrescription = $unServicePrescription->getlistePrescription($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('Vues.formPresciption', compact('leMedicament', 'mesPrescription', 'erreur'));
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

    public function modifierLaPrescription()
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_dosage = Request::input('id_dosage');
                $id_type_individu = Request::input('id_type_individu');
                $posologie = Request::input('posologie');
                $id_oldDosage = Request::input('oldId_dosage');
                $id_oldIndividu = Request::input('oldId_type_individu');

                $unServiceMedicament = new ServiceLeMedicament();
                $unServicePrescription = new ServicePrescription();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $modifPrescription = $unServicePrescription->modifierLaPrescription($id_medicament, $id_dosage, $id_oldDosage, $id_type_individu, $id_oldIndividu, $posologie);
                $mesPrescription = $unServicePrescription->getlistePrescription($id_medicament);
                return view('Vues.formPresciption', compact('leMedicament', 'mesPrescription', 'erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues.pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues.pageErreur', compact('erreur'));
            }
        } else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('Vues.formLogin', compact('erreur'));
        }
    }

    public function modifPrescription($id_medicament, $id_dosage, $id_type_individu)
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceLeMedicament();
                $unServicePrescription = new ServicePrescription();
                $unServiceDosage = new ServiceDosage();
                $unServiceTypeIndividue = new ServiceTypeIndividus();
                $mesPrescriptions = $unServicePrescription->getlistePrescription($id_medicament);
                $laPrescription = $unServicePrescription->getLaPrescription($id_medicament, $id_dosage, $id_type_individu);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $leDosage = $unServiceDosage->getLeDosage($id_dosage);
                $leIndividu = $unServiceTypeIndividue->getLeIndividu($id_type_individu);
                $mesDosages = $unServiceDosage->getLesDosages();
                $mesIndividus = $unServiceTypeIndividue->getLesIndividus();
                return view('Vues.formPrescriptioner', compact('laPrescription', 'leMedicament', 'mesDosages', 'mesIndividus', 'leDosage', 'leIndividu', 'mesPrescriptions', 'erreur'));
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

    public function affichageAjoutPrescription($id_medicament)
    {
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceLeMedicament();
                $unServicePrescription = new ServicePrescription();
                $unServiceDosage = new ServiceDosage();
                $unServiceTypeIndividue = new ServiceTypeIndividus();
                $mesPrescriptions = $unServicePrescription->getlistePrescription($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $mesDosages = $unServiceDosage->getLesDosages();
                $mesIndividus = $unServiceTypeIndividue->getLesIndividus();
                return view('Vues.formPrescriptioner', compact('mesIndividus', 'mesDosages', 'leMedicament', 'mesPrescriptions', 'erreur'));
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
