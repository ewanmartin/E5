<?php

namespace App\dao;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceTypeIndividus
{


    public function getLesIndividus()
    {
        try {
            $lesIndividus = DB::table('type_individu')
                ->Select()
                ->get();
            //liste des indinvidue
            return $lesIndividus;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function getLeIndividu($id_type_individu)
    {
        try {
            $leIndividu = DB::table('type_individu')
                ->Select()
                ->where('type_individu.id_type_individu', '=', $id_type_individu)
                ->get();
            //liste des indinvidue avec un medicament
            return $leIndividu;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

}
