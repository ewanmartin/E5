<?php

namespace App\Http\Controllers;


use App\dao\ServiceLeMedicament;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Exceptions\MonException;

class MedicamentController
{
    public function listerMedicament()
    {
        try {
            $erreur = Session::get('erreur');
            $unMedicament = new ServiceLeMedicament();
            $mesMedicament = $unMedicament->getListeMedicament();
            return view('Vues.formMedicament', compact('mesMedicament'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('Vues.pageErreur', compact('erreur'));
        } catch (\Exception $ex) {
            $monErreur = $ex->getMessage();
            return view('Vues.pageErreur', compact('erreur'));
        }
    }


}
