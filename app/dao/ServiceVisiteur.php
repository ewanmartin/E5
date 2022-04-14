<?php

namespace App\dao;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Fluent\Concerns\Has;

class ServiceVisiteur
{

    public function login($login, $pwd)
    {
        $connected = false;
        try {
            $visiteur = DB::table('visiteur')
                ->select()
                ->where('login_visiteur', [$login])
                ->first();
            if ($visiteur != null) {
                $temp = Hash::make($pwd);
                if (Hash::check($pwd, $visiteur->pwd_visiteur)) {
                    //Session::put('id', $visiteur->id_visiteur);
                    //Session::put('type', $visiteur->type_visiteur);
                    Session::put('id', $visiteur->id_visiteur);
                    Session::put('type', $visiteur->type_visiteur);
                    $connected = true;
                }
            }
        } catch (QueryException $e) {
            throw  new MonException($e->getMessage(), 5);
        }
        return $connected;
    }

    public function logout()
    {
        Session::put('id', 0);
    }

    public static function miseAjourMotPasse($pwd)
    {
        try {
            DB::table('visiteur')
                ->update([
                    'pwd_visiteur' => $pwd
                ]);
        } catch (QueryException $e) {
            throw  new MonException($e->getMessage(), 5);
        }
    }


}
