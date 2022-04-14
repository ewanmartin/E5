<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceLeMedicament
{
    public function getListeMedicament()
    {
        try {
            $query = DB::table('medicament')
                ->select()
                ->join('famille', 'medicament.id_famille', '=', 'famille.id_famille')
                ->get();
            //liste des medicament
            return $query;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function getleMedoc($id_medicament)
    {
        try {
            $lesMedicaments = DB::table('medicament')
                ->Select()
                ->where("id_medicament", "=", $id_medicament)
                ->get();
            //liste medicament précis sur un id medoc
            return $lesMedicaments;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }
}
