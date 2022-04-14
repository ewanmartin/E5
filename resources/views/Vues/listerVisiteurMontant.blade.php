@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-8 col-sm-8">
            <div class="blanc">
                <h1>Liste des frais hors forfait</h1>
            </div>

            <table class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                    <th>id_visiteur</th>
                    <th>id_frais</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>ville</th>
                    <th>montant</th>
                </tr>
                </thead>
                @foreach($mesvisteurMontant as $unvisteurMontant)
                    <tr>
                        <td>{{ $unvisteurMontant->id_visiteur }}</td>
                        <td>{{ $unvisteurMontant->id_frais }}</td>
                        <td>{{ $unvisteurMontant->nom_visiteur }} </td>
                        <td>{{ $unvisteurMontant->prenom_visiteur }} </td>
                        <td>{{ $unvisteurMontant->ville_visiteur }} </td>
                        <td style="text-align:center;"><a
                                href="{{url('/affichermontant')}}/{{ $unvisteurMontant->id_frais }}">
                                <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                                      title="liste"></span></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

