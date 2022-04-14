<?php

namespace App\dao;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceDosage
{

    public function getLesDosages()
    {
        try {
            $lesDosages = DB::table('dosage')
                ->Select()
                ->get();
            //lister tout les dosages
            return $lesDosages;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function getLeDosage($id_dosage)
    {
        try {
            $leDosage = DB::table('dosage')
                ->Select()
                ->where('dosage.id_dosage', '=', $id_dosage)
                ->get();
            //lister une liste de dosage avec un id de medicament
            return $leDosage;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

}
