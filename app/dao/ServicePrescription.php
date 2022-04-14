<?php

namespace App\dao;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServicePrescription
{

    public function getlistePrescription($id_mdeicament)
    {
        try {
            $query = DB::table('prescrire')
                ->Select()
                ->join('medicament', 'medicament.id_medicament', '=', 'prescrire.id_medicament')
                ->join('dosage', 'dosage.id_dosage', '=', 'prescrire.id_dosage')
                ->join('type_individu', 'type_individu.id_type_individu', '=', 'prescrire.id_type_individu')
                ->where('medicament.id_medicament', '=', $id_mdeicament)
                ->get();
            //liste des precipriton pour un medicament
            return $query;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function ajouterlaprescription($id_dosage, $id_medicament, $id_type_individu, $posologie)
    {
        try {
            DB::table('prescrire')->insert(
                [
                    'prescrire.id_dosage' => $id_dosage,
                    'prescrire.id_medicament' => $id_medicament,
                    'prescrire.id_type_individu' => $id_type_individu,
                    'prescrire.posologie' => $posologie]
                //ajouter une presciption
            );
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deletePresciption($id_dosage, $id_medicament, $id_type_individue)
    {
        try {
            DB::table('prescrire')
                ->where('prescrire.id_dosage', '=', $id_dosage)
                ->where('prescrire.id_medicament', '=', $id_medicament)
                ->where('prescrire.id_type_individu', '=', $id_type_individue)
                ->delete();
            //supression prescription 3 id nessesaire
        } catch (QueryException $e) {
            throw  new MonException($e->getMessage(), 5);
        }
    }



    public function getLaPrescription($id_medicament, $id_dosage, $id_type_individu)
    {
        try {
            $laPrescription = DB::table('prescrire')
                ->Select()
                ->where('prescrire.id_medicament', '=', $id_medicament)
                ->where('prescrire.id_dosage', '=', $id_dosage)
                ->where('prescrire.id_type_individu', '=', $id_type_individu)
                ->get();
            //une presciption preci a besoin de 3 ID
            return $laPrescription;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function modifierLaPrescription($id_medicament, $id_dosage, $id_oldDosage, $id_type_individu, $id_oldIndividu, $posologie)
    {
        try {
            DB::table('prescrire')
                ->where('id_medicament', "=", $id_medicament)
                ->where('id_dosage', '=', $id_oldDosage)
                ->where('id_type_individu', '=', $id_oldIndividu)
                ->update([
                        'id_dosage' => $id_dosage,
                        'id_type_individu' => $id_type_individu,
                        'posologie' => $posologie]
                );
            //une presciption preci a besoin de 3 ID de plus ajouter les ancien pour savoir sur le quelle on point
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }


}
