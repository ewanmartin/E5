@extends('layouts.master')
@section('content')
    <h1>Prescription(s) du médicament : {{$leMedicament[0]->nom_commercial}}</h1>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Quantité de dosage</th>
            <th>Type d'individu</th>
            <th>Posologie</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach ($mesPrescription as $ligne)
            <tr>
                <td>{{$ligne->qte_dosage}} PAR {{$ligne->unite_dosage}}</td>
                <td>{{$ligne->lib_type_individu}}</td>
                <td>{{$ligne->posologie}}</td>
                <td><a class="glyphicon glyphicon-pencil"
                       href="{{url('/modifPrescription')}}/{{$ligne->id_medicament}}/{{$ligne->id_dosage}}/{{$ligne->id_type_individu}}"></a>
                </td>
                <td>
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer"
                       href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location= '{{url('/surpprimerPrescription')}}/{{$ligne->id_medicament}}/{{$ligne->id_dosage}}/{{$ligne->id_type_individu}}'; }">
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{url('/affichageAjoutPrescription')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER PRESCRIPTION</a><br><br>
    <button><a href="{{url('/listerMedicament')}}" >retour</a></button>
@stop
