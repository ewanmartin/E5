<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceInteraction
{
    public function listerLsInteractions()
    {
        try {
            $lesInteractions = DB::table('interagir')
                ->Select()
                ->get();
            //lister tout les interactions
            return $lesInteractions;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function getLesInteractions($id_medicament)
    {
        try {
            $lesInteractions = DB::table('interagir')
                ->Select()
                ->join('medicament', 'medicament.id_medicament', '=', 'interagir.med_id_medicament')
                ->where('interagir.id_medicament', '=', $id_medicament)
                ->get();
            //liste des interaction avec un id precis
            return $lesInteractions;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function ajouterLainteraction($id_medicament, $id_med_medicament)
    {
        try {
            DB::table('interagir')->insert(
                [
                    'interagir.id_medicament' => $id_medicament,
                    'interagir.med_id_medicament' => $id_med_medicament]
            );
            //ajouter un interaction avec les ID medicament et le principale l'autre et ce que lon choisi
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function supprInteraction($id_medicament, $id_med_medicament)
    {
        try {
            $lesInteractions = DB::table('interagir')
                ->where('interagir.id_medicament', '=', $id_medicament)
                ->where('interagir.med_id_medicament', '=', $id_med_medicament)
                ->delete();
            //supresion une interaction
            return $lesInteractions;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function getLaIntercation($med_id_medicament)
    {
        try {
            $lesInteractions = DB::table('interagir')
                ->Select()
                ->join('medicament', 'medicament.id_medicament', '=', 'interagir.med_id_medicament')
                ->where('interagir.med_id_medicament', '=', $med_id_medicament)
                ->get();
            //interaction complementaire sur l'id medicament pour trouver le bon
            return $lesInteractions;
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }

    public function modiferLaInteraction($id_medicament, $ancien_med_id_medicament, $new_med_id_medicament)
    {
        try {
            DB::table('interagir')
                ->where('id_medicament', "=", $id_medicament)
                ->where('med_id_medicament', '=', $ancien_med_id_medicament)
                ->update([
                        'med_id_medicament' => $new_med_id_medicament,]
                );
            //modification de l'interaction
        } catch (QueryException $e) {
            throw new Exception($e->getMessage(), 5);
        }
    }
}

