@extends('layouts.master')
@section('content')
    <h1>Les médicament(s) qui intéragissent avec le : {{$leMedicament[0]->nom_commercial}}</h1>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Médicament</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach ($mesInteractions as $ligne)
            <tr>
                <td>{{$ligne->nom_commercial}}</td>
                <td><a class="glyphicon glyphicon-pencil"
                       href="{{url('/modifInteractions')}}/{{$leMedicament[0]->id_medicament}}/{{$ligne->med_id_medicament}}"></a>
                </td>
                <td>
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer"
                       href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location= '{{url('/supprimerInteraction')}}/{{$leMedicament[0]->id_medicament}}/{{$ligne->med_id_medicament}}'; }">
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{url('/ajoutinteraction')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER INTERACTION</a><br><br>
    <button><a href="{{url('/listerMedicament')}}">retour</a></button>
@stop

