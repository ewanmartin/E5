<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceFormuler
{
    public function getlisteFormule($id_mdeicament)
    {
        try {
            $query = DB::table('formuler')
                ->select()
                ->join('presentation', 'formuler.id_presentation', '=', 'presentation.id_presentation')
                ->join('medicament', 'formuler.id_medicament', '=', 'medicament.id_medicament')
                ->where('medicament.id_medicament', '=', $id_mdeicament)
                ->get();
            //retourne la liste des forumles basée sur un id de medicament
            return $query;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteFormule($id_medicament, $id_presentation)
    {
        try {
            DB::table('formuler')
                ->where('id_medicament', '=', $id_medicament)
                ->where('id_presentation', '=', $id_presentation)
                ->delete();
            //Surprime la liste des formule 2 id envoyer car 2 clé primaire pour la supresion (id_medicament et id_presnetation son des clé primaire
        } catch (QueryException $e) {
            throw  new MonException($e->getMessage(), 5);
        }
    }

    public function ajouterLaFormulation($id_medicament, $id_presentation, $qte_formuler)
    {
        try {
            DB::table('formuler')->insert(
                [
                    'formuler.id_medicament' => $id_medicament,
                    'formuler.id_presentation' => $id_presentation,
                    'formuler.qte_formuler' => $qte_formuler]
            );
            //ajouter une formulation id medicament est notre cible
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getByHorsId($id_medicament, $id_presentation)
    {
        try {
            $formule= DB::table('formuler')
                ->select()
                ->where(['id_medicament' => $id_medicament])
                ->where(['id_presentation' => $id_presentation])
                ->first();
            //avoir une fomulation presise avec la presentation
            return $formule;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateFormulation($id_medicament, $oldpresentation, $id_presentation, $qte_formuler)
    {
        try {
            DB::table('formuler')
                ->where('id_medicament', [$id_medicament])
                ->where('id_presentation', [$oldpresentation])
                ->update(['id_presentation' => $id_presentation, 'qte_formuler' => $qte_formuler]);
            //pour changer ID on utilise oldPresentation
        } catch (QueryException $e) {
            throw  new MonException($e->getMessage(), 5);
        }
    }
}
