@extends('layouts.master')
@section('content')
    @if(empty($leDosage))
        <h1>Ajout d'une Prescription avec le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => '/ajouterLaPrescription')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <label>Dosage</label>
        <select name="id_dosage">
            @foreach($mesDosages as $ligne)
                <option value="{{$ligne->id_dosage}}">{{$ligne->qte_dosage}} PAR {{$ligne->unite_dosage}}</option>
            @endforeach
        </select>
        <label>Type d'individu</label>
        <select name="id_type_individu">
            @foreach($mesIndividus as $ligne)
                <option value="{{$ligne->id_type_individu}}">{{$ligne->lib_type_individu}}</option>
            @endforeach
        </select>
        <label>Posologie</label>
        <input type="text" name="posologie"><br><br>
        <button type="submit">Ajouter</button>
        <button><a  href="{{url('/listerPreciption')}}/{{$leMedicament[0]->id_medicament}}">retour</a></button>
        {{ Form::close() }}
    @else
        <h1>Modification d'une Prescription pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => '/modifierLaPrescription')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$leDosage[0]->id_dosage}}" name="oldId_dosage">
        <input type="hidden" value="{{$leIndividu[0]->id_type_individu }}" name="oldId_type_individu">
        <label>Dosage</label>
        <select name="id_dosage">
            @foreach($mesDosages as $ligne)
                <?php $selected = ''?>
                @if(($ligne->id_dosage) == ($leDosage[0]->id_dosage) )
                    <?php $selected = 'selected'?>
                @endif
                <option
                    value="{{$ligne->id_dosage}}" <?php echo $selected?>>{{$ligne->qte_dosage}}
                    PAR {{$ligne->unite_dosage}}</option>
            @endforeach
        </select>
        <label>Type d'individu</label>
        <select name="id_type_individu">
            @foreach($mesIndividus as $ligne)
                <?php $selected = ''?>
                @if(($ligne->id_type_individu) == ($leIndividu[0]->id_type_individu))
                    <?php $selected = "selected"?>
                @endif
                <option
                    value="{{$ligne->id_type_individu}}" <?php echo $selected?>>{{$ligne->lib_type_individu}}</option>
            @endforeach
        </select>
        <label>Posologie</label>
        <input type="text" name="posologie" value="{{$laPrescription[0]->posologie}}"><br><br>
        <button type="submit">Modifier</button>
        <button><a  href="{{url('/listerPreciption')}}/{{$leMedicament[0]->id_medicament}}">retour</a></button>
        {{ Form::close() }}
    @endif
@stop

