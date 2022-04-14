@extends('layouts.master')
@section('content')
    <h1>pour le {{$leMedicament[0]->nom_commercial}}</h1>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>presentation</th>
            <th>qte</th>
            <th>modifier</th>
            <th>suprimer</th>
        </tr>
        </thead>
        @foreach($mesFormulations as $uneFormulation)
            <tr>
                <td>{{$uneFormulation->lib_presentation}}</td>
                <td> {{ $uneFormulation->qte_formuler }} </td>
                <td>
                    <a href="{{url('/updateFormulation')}}/{{ $uneFormulation->id_medicament }}/{{ $uneFormulation->id_presentation }}">
                        <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                              title="Modifier"></span></a></td>
                <td>
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer"
                       href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location= '{{url('/surpprimerFormule')}}/{{ $uneFormulation->id_medicament }}/{{ $uneFormulation->id_presentation }}'; }">
                    </a></td>
            </tr>
        @endforeach
    </table>
    <a href="{{url('/affichageAjoutFormulation')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER FORMULATION</a><br>
    <br>
    <button><a href="{{url('/listerMedicament')}}">retour</a></button>
@stop
